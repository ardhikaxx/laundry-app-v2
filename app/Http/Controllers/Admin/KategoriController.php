<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriLayanan;
use App\Http\Requests\KategoriRequest;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = KategoriLayanan::withCount('layanan')->latest()->paginate(15);
        return view('admin.kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(KategoriRequest $request)
    {
        KategoriLayanan::create($request->validated());
        return redirect()->route('admin.kategori.index')->with('success', 'Data kategori berhasil disimpan.');
    }

    public function edit(KategoriLayanan $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(KategoriRequest $request, KategoriLayanan $kategori)
    {
        $kategori->update($request->validated());
        return redirect()->route('admin.kategori.index')->with('success', 'Data kategori berhasil diperbarui.');
    }

    public function destroy(KategoriLayanan $kategori)
    {
        if ($kategori->layanan()->count() > 0) {
            return redirect()->back()->with('error', 'Kategori tidak dapat dihapus karena masih digunakan oleh layanan.');
        }

        $kategori->delete();
        return redirect()->route('admin.kategori.index')->with('success', 'Data kategori berhasil dihapus.');
    }
}
