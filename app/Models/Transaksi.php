<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';

    protected $fillable = [
        'no_order',
        'pelanggan_id',
        'pegawai_id',
        'tanggal_masuk',
        'tanggal_estimasi',
        'tanggal_selesai',
        'tanggal_ambil',
        'subtotal',
        'total',
        'bayar',
        'kembalian',
        'metode_bayar',
        'status',
        'catatan'
    ];

    public function pelanggan()     { return $this->belongsTo(Pelanggan::class); }
    public function pegawai()       { return $this->belongsTo(Pegawai::class); }
    public function detail()        { return $this->hasMany(DetailTransaksi::class); }
    public function riwayatStatus() { return $this->hasMany(StatusTransaksi::class); }

    public function getWarnaBadgeAttribute(): string
    {
        return match($this->status) {
            'diterima'  => 'secondary',
            'dicuci'    => 'info',
            'dijemur'   => 'warning',
            'disetrika' => 'warning',
            'siap'      => 'success',
            'diambil'   => 'primary',
            'batal'     => 'danger',
            default     => 'secondary',
        };
    }
}
