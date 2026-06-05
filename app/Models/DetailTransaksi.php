<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    protected $table = 'detail_transaksi';

    protected $fillable = [
        'transaksi_id',
        'layanan_id',
        'nama_layanan',
        'satuan',
        'harga_satuan',
        'qty',
        'subtotal',
        'keterangan'
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }
}
