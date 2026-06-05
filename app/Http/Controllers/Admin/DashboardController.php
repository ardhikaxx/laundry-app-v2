<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalLayanan = Layanan::where('is_active', 1)->count();
        $totalPelanggan = Pelanggan::where('is_active', 1)->count();
        $transaksiHariIni = Transaksi::whereDate('tanggal_masuk', today())->count();
        $pendapatanBulanIni = Transaksi::whereMonth('tanggal_masuk', now()->month)
                                       ->whereYear('tanggal_masuk', now()->year)
                                       ->where('status', '!=', 'batal')
                                       ->sum('total');

        $transaksiTerbaru = Transaksi::with('pelanggan')->latest()->take(5)->get();
        $pelangganTerbaru = Pelanggan::latest()->take(5)->get();
        
        $layananPopuler = DB::table('detail_transaksi')
            ->join('transaksi', 'detail_transaksi.transaksi_id', '=', 'transaksi.id')
            ->select('detail_transaksi.layanan_id', 'detail_transaksi.nama_layanan', DB::raw('SUM(detail_transaksi.qty) as total_qty'))
            ->whereMonth('transaksi.tanggal_masuk', now()->month)
            ->whereYear('transaksi.tanggal_masuk', now()->year)
            ->groupBy('detail_transaksi.layanan_id', 'detail_transaksi.nama_layanan')
            ->orderByDesc('total_qty')
            ->take(5)
            ->get();

        return view('admin.dashboard.index', compact(
            'totalLayanan', 'totalPelanggan', 'transaksiHariIni', 'pendapatanBulanIni',
            'transaksiTerbaru', 'pelangganTerbaru', 'layananPopuler'
        ));
    }
}
