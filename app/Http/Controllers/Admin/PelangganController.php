<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use App\Http\Requests\PelangganRequest;
use App\Services\NomorOrderService;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PelangganController extends Controller
{
    public function index(Request $request)
    {
        $pelanggans = Pelanggan::filter($request->all())->latest()->paginate(15)->withQueryString();
        return view('admin.pelanggan.index', compact('pelanggans'));
    }

    public function create()
    {
        return view('admin.pelanggan.create');
    }

    public function store(PelangganRequest $request)
    {
        $data = $request->validated();
        $data['kode_pelanggan'] = NomorOrderService::generate('PLG', 'pelanggan', 'kode_pelanggan', 4);
        
        Pelanggan::create($data);
        return redirect()->route('admin.pelanggan.index')->with('success', 'Data pelanggan berhasil disimpan.');
    }

    public function show(Pelanggan $pelanggan)
    {
        $transaksis = $pelanggan->transaksi()->latest()->paginate(10);
        return view('admin.pelanggan.show', compact('pelanggan', 'transaksis'));
    }

    public function edit(Pelanggan $pelanggan)
    {
        return view('admin.pelanggan.edit', compact('pelanggan'));
    }

    public function update(PelangganRequest $request, Pelanggan $pelanggan)
    {
        $pelanggan->update($request->validated());
        return redirect()->route('admin.pelanggan.index')->with('success', 'Data pelanggan berhasil diperbarui.');
    }

    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->update(['is_active' => 0]);
        return redirect()->route('admin.pelanggan.index')->with('success', 'Data pelanggan dinonaktifkan.');
    }

    public function cetak(Pelanggan $pelanggan)
    {
        $pdf = Pdf::loadView('pdf.pelanggan', compact('pelanggan'))
                   ->setPaper('a4', 'portrait');
        return $pdf->stream("pelanggan-{$pelanggan->kode_pelanggan}.pdf");
    }

    public function cetakSemua(Request $request)
    {
        $pelanggan = Pelanggan::filter($request->all())->get();
        $pdf = Pdf::loadView('pdf.pelanggan_semua', compact('pelanggan'))
                   ->setPaper('a4', 'portrait');
        return $pdf->stream('data-pelanggan.pdf');
    }
}
