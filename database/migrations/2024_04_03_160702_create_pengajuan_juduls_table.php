<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengajuan_juduls', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('anggota')->nullable();
            $table->enum('judul_dosen', ['Ya', 'Tidak']);
            $table->string('judul');
            $table->string('sub_judul')->nullable();
            $table->text('abstrak');
            $table->string('studi_kasus');
            $table->string('status');
            $table->string('sumber_referensi');
            $table->string('dosen_pilihan');
            $table->string('dosen_terpilih');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_juduls');
    }
};
