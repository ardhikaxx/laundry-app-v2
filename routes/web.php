<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\PelangganController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Admin\PegawaiController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\LayananPublicController;
use App\Http\Controllers\Public\PelangganPublicController;

// ─── Halaman Publik (tanpa login) ───────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/layanan',  [LayananPublicController::class, 'index'])->name('public.layanan');
Route::get('/pelanggan',[PelangganPublicController::class, 'index'])->name('public.pelanggan');
Route::get('/pelanggan/{kode_pelanggan}',[PelangganPublicController::class, 'show'])->name('public.pelanggan.show');

// ─── Auth ────────────────────────────────────────────────────────────
Route::get('/login',  [LoginController::class, 'showForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout',[LoginController::class, 'logout'])->name('logout');

// ─── Panel Admin (wajib login + role admin) ──────────────────────────
Route::prefix('admin')->name('admin.')->middleware(['auth', 'isAdmin'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Kategori Layanan
    Route::resource('kategori', KategoriController::class);

    // Layanan
    Route::resource('layanan', LayananController::class);

    // Pelanggan
    Route::get('pelanggan/cetak-semua',       [PelangganController::class, 'cetakSemua'])->name('pelanggan.cetak-semua');
    Route::get('pelanggan/{pelanggan}/cetak', [PelangganController::class, 'cetak'])->name('pelanggan.cetak');
    Route::resource('pelanggan', PelangganController::class);

    // Transaksi
    Route::patch('transaksi/{transaksi}/status', [TransaksiController::class, 'updateStatus'])->name('transaksi.status');
    Route::patch('transaksi/{transaksi}/bayar',  [TransaksiController::class, 'bayar'])->name('transaksi.bayar');
    Route::patch('transaksi/{transaksi}/batal',  [TransaksiController::class, 'batal'])->name('transaksi.batal');
    Route::get('transaksi/{transaksi}/nota',     [TransaksiController::class, 'nota'])->name('transaksi.nota');
    Route::resource('transaksi', TransaksiController::class)->except(['edit','update','destroy']);

    // Pegawai
    Route::resource('pegawai', PegawaiController::class);

    // Laporan
    Route::get('laporan',            [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('laporan/cetak',      [LaporanController::class, 'cetak'])->name('laporan.cetak');
    Route::get('laporan/export-pdf', [LaporanController::class, 'exportPdf'])->name('laporan.export-pdf');
});
