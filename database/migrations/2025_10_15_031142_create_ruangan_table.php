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
        Schema::create('ruangan', function (Blueprint $table) {
            $table->id();

            // relasi
            // untuk menentukan pimpinan ruangan
            $table->foreignId('user_id')
            ->constrained('users')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();

            // jangan diikutin
            // $table->bigInteger('user_id')->unsigned();
            // $table->foreign('user_id')->references('nik')->on('users')->cascadeOnDelete();
            // ======================

            // field
            $table->string('nama_ruangan');
            $table->string('kode_ruangan')->unique();
            $table->string('lantai');
            $table->string('ukuran');
            $table->string('gambar');
            $table->text('deskripsi');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruangan');
    }
};
