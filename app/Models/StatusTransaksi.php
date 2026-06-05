<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusTransaksi extends Model
{
    protected $table = 'status_transaksi';

    protected $fillable = [
        'transaksi_id',
        'status',
        'keterangan',
        'diubah_oleh'
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'diubah_oleh');
    }
}
