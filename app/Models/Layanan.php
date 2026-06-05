<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $table = 'layanan';

    protected $fillable = [
        'kategori_layanan_id',
        'kode_layanan',
        'nama_layanan',
        'satuan',
        'harga',
        'estimasi_hari',
        'deskripsi',
        'is_active'
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriLayanan::class, 'kategori_layanan_id');
    }

    public function scopeAktif($query)
    {
        return $query->where('is_active', 1);
    }
}
