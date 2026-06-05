<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';

    protected $fillable = [
        'kode_pelanggan',
        'nama_pelanggan',
        'jenis_kelamin',
        'no_telepon',
        'email',
        'alamat',
        'tanggal_daftar',
        'total_transaksi',
        'catatan',
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

    public function scopeFilter($query, array $filters)
    {
        if (!empty($filters['cari'])) {
            $query->where(function($q) use ($filters) {
                $q->where('nama_pelanggan', 'like', "%{$filters['cari']}%")
                  ->orWhere('kode_pelanggan', 'like', "%{$filters['cari']}%")
                  ->orWhere('no_telepon',     'like', "%{$filters['cari']}%");
            });
        }
        if (!empty($filters['jenis_kelamin'])) {
            $query->where('jenis_kelamin', $filters['jenis_kelamin']);
        }
        if (isset($filters['is_active']) && $filters['is_active'] !== '') {
            $query->where('is_active', $filters['is_active']);
        }
        return $query;
    }
}
