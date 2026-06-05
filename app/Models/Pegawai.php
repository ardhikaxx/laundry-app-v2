<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawai';

    protected $fillable = [
        'kode_pegawai',
        'nama_pegawai',
        'jabatan',
        'no_telepon',
        'alamat',
        'tanggal_masuk',
        'is_active'
    ];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function scopeAktif($query)
    {
        return $query->where('is_active', 1);
    }
}
