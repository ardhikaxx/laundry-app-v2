<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Http\Requests\PegawaiRequest;
use App\Services\NomorOrderService;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawais = Pegawai::latest()->paginate(15);
        return view('admin.pegawai.index', compact('pegawais'));
    }

    public function create()
    {
        return view('admin.pegawai.create');
    }

    public function store(PegawaiRequest $request)
    {
        $data = $request->validated();
        $data['kode_pegawai'] = NomorOrderService::generate('PGW', 'pegawai', 'kode_pegawai', 3);
        
        Pegawai::create($data);
        return redirect()->route('admin.pegawai.index')->with('success', 'Data pegawai berhasil disimpan.');
    }

    public function edit(Pegawai $pegawai)
    {
        return view('admin.pegawai.edit', compact('pegawai'));
    }

    public function update(PegawaiRequest $request, Pegawai $pegawai)
    {
        $pegawai->update($request->validated());
        return redirect()->route('admin.pegawai.index')->with('success', 'Data pegawai berhasil diperbarui.');
    }

    public function destroy(Pegawai $pegawai)
    {
        if ($pegawai->transaksi()->count() > 0) {
            $pegawai->update(['is_active' => 0]);
            return redirect()->back()->with('warning', 'Pegawai dinonaktifkan karena telah terhubung dengan transaksi.');
        }

        $pegawai->delete();
        return redirect()->route('admin.pegawai.index')->with('success', 'Data pegawai berhasil dihapus.');
    }
}
