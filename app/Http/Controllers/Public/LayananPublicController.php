<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\KategoriLayanan;
use Illuminate\Http\Request;

class LayananPublicController extends Controller
{
    public function index(Request $request)
    {
        $kategoriId = $request->kategori;
        $kategoris = KategoriLayanan::where('is_active', 1)->get();
        
        $layanans = Layanan::aktif()->with('kategori')
            ->when($kategoriId, function($query, $kategoriId) {
                return $query->where('kategori_layanan_id', $kategoriId);
            })
            ->get();

        return view('public.layanan', compact('kategoris', 'layanans', 'kategoriId'));
    }
}
