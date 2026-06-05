<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\StatusTransaksi;
use App\Models\Pelanggan;
use App\Models\Pegawai;
use App\Models\Layanan;
use App\Services\NomorOrderService;
use Carbon\Carbon;

class TransaksiSeeder extends Seeder
{
    public function run(): void
    {
        $pelanggan = Pelanggan::first();
        $pegawai = Pegawai::first();
        $layanan = Layanan::first();

        if ($pelanggan && $pegawai && $layanan) {
            $transaksi = Transaksi::create([
                'no_order' => NomorOrderService::generate('ORD', 'transaksi', 'no_order', 5),
                'pelanggan_id' => $pelanggan->id,
                'pegawai_id' => $pegawai->id,
                'tanggal_masuk' => Carbon::now()->subDays(2),
                'tanggal_estimasi' => Carbon::now(),
                'subtotal' => $layanan->harga * 2,
                'total' => $layanan->harga * 2,
                'bayar' => $layanan->harga * 2,
                'kembalian' => 0,
                'metode_bayar' => 'tunai',
                'status' => 'diterima'
            ]);

            DetailTransaksi::create([
                'transaksi_id' => $transaksi->id,
                'layanan_id' => $layanan->id,
                'nama_layanan' => $layanan->nama_layanan,
                'satuan' => $layanan->satuan,
                'harga_satuan' => $layanan->harga,
                'qty' => 2,
                'subtotal' => $layanan->harga * 2
            ]);

            StatusTransaksi::create([
                'transaksi_id' => $transaksi->id,
                'status' => 'diterima',
                'keterangan' => 'Pesanan diterima',
                'diubah_oleh' => 1
            ]);
        }
    }
}
