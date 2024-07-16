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
        Schema::create('pengajuan_kompetensis', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->text('judul_skripsi_inggris');
            $table->text('kompetensi');
            $table->text('bukti_kompetensi');
            $table->string('status');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_kompetensis');
    }
};
