<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('status_transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaksi_id')->constrained('transaksi')->onDelete('cascade');
            $table->string('status', 50);
            $table->text('keterangan')->nullable();
            $table->foreignId('diubah_oleh')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('status_transaksi');
    }
};
