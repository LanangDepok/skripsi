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
        Schema::create('pengajuan_revisis', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pengajuan_skripsi_id');
            $table->text('revisi_alat')->nullable();
            $table->text('revisi_laporan')->nullable();
            $table->string('terima_penguji1')->nullable();
            $table->string('terima_penguji2')->nullable();
            $table->string('terima_penguji3')->nullable();
            $table->string('terima_pembimbing')->nullable();
            $table->text('link_revisi_alat')->nullable();
            $table->text('keterangan_penguji1')->nullable();
            $table->text('keterangan_penguji2')->nullable();
            $table->text('keterangan_penguji3')->nullable();
            $table->text('keterangan_pembimbing')->nullable();
            $table->string('status');
            $table->string('ttd_komite')->nullable();
            $table->string('deadline');
            $table->string('tanggal_revisi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_revisis');
    }
};
