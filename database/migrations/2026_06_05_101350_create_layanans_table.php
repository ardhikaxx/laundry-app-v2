<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('layanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_layanan_id')->constrained('kategori_layanan')->onDelete('restrict');
            $table->string('kode_layanan', 20)->unique();
            $table->string('nama_layanan', 150);
            $table->enum('satuan', ['kg', 'pcs', 'item'])->default('kg');
            $table->decimal('harga', 12, 2)->default(0);
            $table->unsignedTinyInteger('estimasi_hari')->default(1);
            $table->text('deskripsi')->nullable();
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('layanan');
    }
};
