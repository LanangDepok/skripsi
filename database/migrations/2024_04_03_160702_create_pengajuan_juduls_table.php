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
            $table->text('judul');
            $table->text('sub_judul')->nullable();
            $table->text('abstrak');
            $table->text('studi_kasus');
            $table->text('status');
            $table->text('sumber_referensi');
            $table->string('dosen_pilihan');
            // $table->string('dosen_terpilih')->nullable();
            // $table->string('dosen_terpilih2')->nullable();
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
