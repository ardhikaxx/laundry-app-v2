<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriLayanan;

class KategoriLayananSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = ['Reguler', 'Express', 'Premium', 'Dry Clean', 'Setrika Saja'];
        foreach ($kategori as $nama) {
            KategoriLayanan::create(['nama_kategori' => $nama, 'is_active' => 1]);
        }
    }
}
