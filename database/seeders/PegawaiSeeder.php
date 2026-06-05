<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pegawai;
use App\Services\NomorOrderService;
use Carbon\Carbon;

class PegawaiSeeder extends Seeder
{
    public function run(): void
    {
        $jabatan = ['Kasir', 'Tukang Cuci', 'Tukang Setrika'];
        foreach ($jabatan as $i => $jbt) {
            Pegawai::create([
                'kode_pegawai' => NomorOrderService::generate('PGW', 'pegawai', 'kode_pegawai', 3),
                'nama_pegawai' => 'Pegawai ' . ($i + 1),
                'jabatan' => $jbt,
                'no_telepon' => '08987654321' . $i,
                'alamat' => 'Jl. Pegawai No. ' . ($i + 1),
                'tanggal_masuk' => Carbon::now()->subMonths(rand(1, 12)),
                'is_active' => 1
            ]);
        }
    }
}
