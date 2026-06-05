<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('no_order', 30)->unique();
            $table->foreignId('pelanggan_id')->constrained('pelanggan')->onDelete('restrict');
            $table->foreignId('pegawai_id')->nullable()->constrained('pegawai')->onDelete('set null');
            $table->date('tanggal_masuk');
            $table->date('tanggal_estimasi');
            $table->date('tanggal_selesai')->nullable();
            $table->dateTime('tanggal_ambil')->nullable();
            $table->decimal('subtotal', 12, 2)->default(0);
            $table->decimal('total', 12, 2)->default(0);
            $table->decimal('bayar', 12, 2)->nullable();
            $table->decimal('kembalian', 12, 2)->nullable();
            $table->enum('metode_bayar', ['tunai', 'transfer', 'qris', 'dompet_digital'])->default('tunai');
            $table->enum('status', ['diterima', 'dicuci', 'dijemur', 'disetrika', 'siap', 'diambil', 'batal'])->default('diterima');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
