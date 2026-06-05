<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganPublicController extends Controller
{
    public function index(Request $request)
    {
        $cari = $request->cari;
        $pelanggans = collect();
        
        if ($cari) {
            $pelanggans = Pelanggan::aktif()
                ->where('nama_pelanggan', 'like', "%{$cari}%")
                ->orWhere('kode_pelanggan', 'like', "%{$cari}%")
                ->orWhere('no_telepon', 'like', "%{$cari}%")
                ->get();
        }

        return view('public.pelanggan', compact('pelanggans', 'cari'));
    }

    public function show($kode_pelanggan)
    {
        $pelanggan = Pelanggan::aktif()->where('kode_pelanggan', $kode_pelanggan)->firstOrFail();
        $transaksis = $pelanggan->transaksi()->with('detail')->latest()->get();
        
        return view('public.pelanggan_show', compact('pelanggan', 'transaksis'));
    }
}
