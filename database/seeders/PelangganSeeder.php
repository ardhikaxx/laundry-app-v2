<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pelanggan;
use App\Services\NomorOrderService;
use Carbon\Carbon;

class PelangganSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            Pelanggan::create([
                'kode_pelanggan' => NomorOrderService::generate('PLG', 'pelanggan', 'kode_pelanggan', 4),
                'nama_pelanggan' => 'Pelanggan ' . $i,
                'jenis_kelamin' => $i % 2 == 0 ? 'P' : 'L',
                'no_telepon' => '08123456789' . $i,
                'email' => 'pelanggan' . $i . '@example.com',
                'alamat' => 'Jl. Pelanggan No. ' . $i,
                'tanggal_daftar' => Carbon::now()->subDays(rand(1, 30)),
                'poin' => 0,
                'total_transaksi' => 0,
                'is_active' => 1
            ]);
        }
    }
}
