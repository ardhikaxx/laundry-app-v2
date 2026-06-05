<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\KategoriLayanan;
use App\Http\Requests\LayananRequest;
use App\Services\NomorOrderService;

class LayananController extends Controller
{
    public function index()
    {
        $layanans = Layanan::with('kategori')->latest()->paginate(15);
        return view('admin.layanan.index', compact('layanans'));
    }

    public function create()
    {
        $kategoris = KategoriLayanan::where('is_active', 1)->get();
        return view('admin.layanan.create', compact('kategoris'));
    }

    public function store(LayananRequest $request)
    {
        $data = $request->validated();
        $data['kode_layanan'] = NomorOrderService::generate('LYN', 'layanan', 'kode_layanan', 3);
        
        Layanan::create($data);
        return redirect()->route('admin.layanan.index')->with('success', 'Data layanan berhasil disimpan.');
    }

    public function show(Layanan $layanan)
    {
        return view('admin.layanan.show', compact('layanan'));
    }

    public function edit(Layanan $layanan)
    {
        $kategoris = KategoriLayanan::where('is_active', 1)->get();
        return view('admin.layanan.edit', compact('layanan', 'kategoris'));
    }

    public function update(LayananRequest $request, Layanan $layanan)
    {
        $layanan->update($request->validated());
        return redirect()->route('admin.layanan.index')->with('success', 'Data layanan berhasil diperbarui.');
    }

    public function destroy(Layanan $layanan)
    {
        // Pengecekan relasi detail transaksi tidak diminta secara eksplisit sebagai error, 
        // tapi rule menyebutkan "Layanan tidak bisa dihapus jika ada pada detail_transaksi. Soft-disable saja."
        // Mari kita cek apakah ada di detail_transaksi
        $count = \App\Models\DetailTransaksi::where('layanan_id', $layanan->id)->count();
        if ($count > 0) {
            $layanan->update(['is_active' => 0]);
            return redirect()->back()->with('warning', 'Layanan dinonaktifkan karena telah digunakan dalam transaksi.');
        }

        $layanan->delete();
        return redirect()->route('admin.layanan.index')->with('success', 'Data layanan berhasil dihapus.');
    }
}
