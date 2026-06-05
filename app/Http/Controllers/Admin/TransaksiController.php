<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\StatusTransaksi;
use App\Models\Pelanggan;
use App\Models\Pegawai;
use App\Models\Layanan;
use App\Http\Requests\TransaksiRequest;
use App\Services\NomorOrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with(['pelanggan'])->latest()->paginate(15);
        return view('admin.transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $pelanggans = Pelanggan::where('is_active', 1)->get();
        $pegawais = Pegawai::where('is_active', 1)->get();
        $layanans = Layanan::where('is_active', 1)->get();
        return view('admin.transaksi.create', compact('pelanggans', 'pegawais', 'layanans'));
    }

    public function store(TransaksiRequest $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->validated();
            
            // Kalkulasi subtotal & estimasi
            $subtotal = 0;
            $maxEstimasi = 0;
            $detailData = [];

            foreach ($data['items'] as $item) {
                $layanan = Layanan::findOrFail($item['layanan_id']);
                $itemSubtotal = $layanan->harga * $item['qty'];
                $subtotal += $itemSubtotal;
                
                if ($layanan->estimasi_hari > $maxEstimasi) {
                    $maxEstimasi = $layanan->estimasi_hari;
                }

                $detailData[] = [
                    'layanan_id' => $layanan->id,
                    'nama_layanan' => $layanan->nama_layanan,
                    'satuan' => $layanan->satuan,
                    'harga_satuan' => $layanan->harga,
                    'qty' => $item['qty'],
                    'subtotal' => $itemSubtotal,
                ];
            }

            $tanggalEstimasi = Carbon::parse($data['tanggal_masuk'])->addDays($maxEstimasi);

            $transaksi = Transaksi::create([
                'no_order' => NomorOrderService::generate('ORD', 'transaksi', 'no_order', 5),
                'pelanggan_id' => $data['pelanggan_id'],
                'pegawai_id' => $data['pegawai_id'] ?? null,
                'tanggal_masuk' => $data['tanggal_masuk'],
                'tanggal_estimasi' => $tanggalEstimasi,
                'subtotal' => $subtotal,
                'total' => $subtotal,
                'metode_bayar' => $data['metode_bayar'],
                'status' => 'diterima',
                'catatan' => $data['catatan'] ?? null,
            ]);

            foreach ($detailData as $detail) {
                $detail['transaksi_id'] = $transaksi->id;
                DetailTransaksi::create($detail);
            }

            StatusTransaksi::create([
                'transaksi_id' => $transaksi->id,
                'status' => 'diterima',
                'keterangan' => 'Transaksi baru dibuat',
                'diubah_oleh' => auth()->id()
            ]);

            DB::commit();
            return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function show(Transaksi $transaksi)
    {
        $transaksi->load(['pelanggan', 'pegawai', 'detail', 'riwayatStatus.user']);
        return view('admin.transaksi.show', compact('transaksi'));
    }

    public function updateStatus(Request $request, Transaksi $transaksi)
    {
        $request->validate(['status' => 'required|in:diterima,dicuci,dijemur,disetrika,siap,diambil']);
        
        $newStatus = $request->status;

        if ($transaksi->status === 'batal') {
            return redirect()->back()->with('warning', 'Transaksi yang dibatalkan tidak bisa diubah statusnya.');
        }
        if ($transaksi->status === 'diambil') {
            return redirect()->back()->with('warning', 'Transaksi yang sudah diambil tidak bisa diubah statusnya.');
        }

        try {
            DB::beginTransaction();

            $transaksi->status = $newStatus;
            
            if ($newStatus === 'siap') {
                $transaksi->tanggal_selesai = now();
            } elseif ($newStatus === 'diambil') {
                $transaksi->tanggal_ambil = now();
                
                // Tambah total transaksi
                $pelanggan = $transaksi->pelanggan;
                $pelanggan->total_transaksi += 1;
                $pelanggan->save();
            }

            $transaksi->save();

            StatusTransaksi::create([
                'transaksi_id' => $transaksi->id,
                'status' => $newStatus,
                'keterangan' => 'Status diperbarui ke ' . $newStatus,
                'diubah_oleh' => auth()->id()
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Status transaksi berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan.');
        }
    }

    public function bayar(Request $request, Transaksi $transaksi)
    {
        $request->validate(['bayar' => 'required|numeric|min:' . $transaksi->total]);

        $transaksi->update([
            'bayar' => $request->bayar,
            'kembalian' => $request->bayar - $transaksi->total
        ]);

        return redirect()->back()->with('success', 'Pembayaran berhasil dicatat.');
    }

    public function batal(Transaksi $transaksi)
    {
        // Jika sudah batal, tidak bisa batal lagi
        if ($transaksi->status === 'batal') {
            return redirect()->back()->with('warning', 'Transaksi sudah dalam status batal.');
        }

        // Boleh batal jika: Belum lunas ATAU belum masuk status final (siap/diambil)
        $bolehBatal = ($transaksi->bayar < $transaksi->total) || !in_array($transaksi->status, ['siap', 'diambil']);

        if (!$bolehBatal) {
            return redirect()->back()->with('warning', 'Transaksi yang sudah lunas dan siap/diambil tidak dapat dibatalkan.');
        }

        try {
            DB::beginTransaction();
            $transaksi->update(['status' => 'batal']);
            StatusTransaksi::create([
                'transaksi_id' => $transaksi->id,
                'status' => 'batal',
                'keterangan' => 'Transaksi dibatalkan',
                'diubah_oleh' => auth()->id()
            ]);
            DB::commit();
            return redirect()->back()->with('success', 'Transaksi berhasil dibatalkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal membatalkan transaksi.');
        }
    }

    public function nota(Transaksi $transaksi)
    {
        if ($transaksi->status === 'batal') {
            return redirect()->back()->with('error', 'Nota tidak dapat dicetak karena transaksi telah dibatalkan.');
        }

        $transaksi->load(['pelanggan', 'pegawai', 'detail']);
        $pdf = Pdf::loadView('pdf.transaksi', compact('transaksi'))
                   ->setPaper('a4', 'portrait');
        return $pdf->stream("nota-{$transaksi->no_order}.pdf");
    }
}
