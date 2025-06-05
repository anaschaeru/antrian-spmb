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
        Schema::create('antrian', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_formulir')->unique();
            $table->string('nama');
            $table->date('tanggal_lahir');
            $table->string('asal_sekolah');
            $table->string('nomor_telpon');
            $table->integer('nomor_antrian')->unique();
            $table->date('tanggal_kumpul')->nullable();
            $table->string('ruang_tes')->nullable();
            $table->string('sesi_tes')->nullable();
            $table->boolean('status_berkas')->default(false); // False = Belum menyerahkan, True = Sudah menyerahkan
            $table->string('konsentrasi_1')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antrians');
    }
};
