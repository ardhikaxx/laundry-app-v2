<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaksi_id')->constrained('transaksi')->onDelete('cascade');
            $table->foreignId('layanan_id')->constrained('layanan')->onDelete('restrict');
            $table->string('nama_layanan', 150);
            $table->string('satuan', 20);
            $table->decimal('harga_satuan', 12, 2);
            $table->decimal('qty', 8, 2)->default(1);
            $table->decimal('subtotal', 12, 2)->default(0);
            $table->string('keterangan', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_transaksi');
    }
};
