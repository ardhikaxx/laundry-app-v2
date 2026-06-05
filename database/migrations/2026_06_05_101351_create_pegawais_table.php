<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pegawai', 20)->unique();
            $table->string('nama_pegawai', 150);
            $table->string('jabatan', 100);
            $table->string('no_telepon', 20)->nullable();
            $table->text('alamat')->nullable();
            $table->date('tanggal_masuk');
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
