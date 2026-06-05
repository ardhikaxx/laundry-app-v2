<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pelanggan', 20)->unique();
            $table->string('nama_pelanggan', 150);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('no_telepon', 20);
            $table->string('email', 100)->nullable();
            $table->text('alamat');
            $table->date('tanggal_daftar');
            $table->unsignedInteger('poin')->default(0);
            $table->unsignedInteger('total_transaksi')->default(0);
            $table->text('catatan')->nullable();
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pelanggan');
    }
};
