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
        Schema::create('pengajuan_sempros', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('mahasiswa_id');
            $table->bigInteger('dospem_id');
            $table->bigInteger('penguji1_id')->nullable();
            $table->bigInteger('penguji2_id')->nullable();
            $table->bigInteger('penguji3_id')->nullable();
            $table->text('metode');
            $table->text('bukti_registrasi');
            $table->string('status');
            $table->text('keterangan')->nullable();
            $table->string('tanggal')->nullable();
            $table->string('nilai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_sempros');
    }
};
