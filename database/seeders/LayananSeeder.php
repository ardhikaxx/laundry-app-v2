<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Layanan;
use App\Models\KategoriLayanan;
use App\Services\NomorOrderService;

class LayananSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = KategoriLayanan::where('nama_kategori', 'Reguler')->first();
        if ($kategori) {
            Layanan::create([
                'kategori_layanan_id' => $kategori->id,
                'kode_layanan' => NomorOrderService::generate('LYN', 'layanan', 'kode_layanan', 3),
                'nama_layanan' => 'Cuci Kering Setrika',
                'satuan' => 'kg',
                'harga' => 7000,
                'estimasi_hari' => 2,
                'is_active' => 1
            ]);
        }
    }
}
