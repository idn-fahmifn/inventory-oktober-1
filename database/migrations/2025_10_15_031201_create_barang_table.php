<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ruangan_id')
            ->constrained('ruangan')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();

            $table->string('nama_barang');
            $table->string('kode_barang')->unique();
            $table->string('tipe');
            $table->string('brand');
            $table->string('gambar');
            $table->enum('jenis', ['elektronik', 'alat berat', 'atk', 'alat kebersihan', 'kendaraan', 'lainnya']);
            $table->enum('kondisi', ['baik', 'rusak', 'sedang diperbaiki'])->default('baik');
            $table->text('deskripsi');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
