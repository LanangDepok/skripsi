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
            $table->bigInteger('dospem2_id')->nullable();
            $table->bigInteger('penguji1_id')->nullable();
            $table->bigInteger('penguji2_id')->nullable();
            $table->bigInteger('penguji3_id')->nullable();
            $table->text('metode');
            $table->text('bukti_registrasi');
            $table->string('status');
            $table->string('tanggal')->nullable();
            $table->string('acc_dospem')->nullable();
            $table->double('nilai')->nullable();
            $table->double('kriteria1')->nullable();
            $table->double('kriteria2')->nullable();
            $table->double('kriteria3')->nullable();
            $table->double('kriteria4')->nullable();
            $table->double('kriteria5')->nullable();
            $table->text('keterangan_ditolak')->nullable();
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
