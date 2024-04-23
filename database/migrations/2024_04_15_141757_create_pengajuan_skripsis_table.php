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
        Schema::create('pengajuan_skripsis', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('mahasiswa_id');
            $table->bigInteger('dospem_id');
            $table->bigInteger('penguji1_id')->nullable();
            $table->bigInteger('penguji2_id')->nullable();
            $table->bigInteger('penguji3_id')->nullable();
            $table->text('link_presentasi');
            // $table->string('membuat_alat');
            $table->string('sertifikat_lomba');
            $table->string('status');
            $table->string('tanggal')->nullable();
            $table->string('nilai1')->nullable();
            $table->string('nilai2')->nullable();
            $table->string('nilai3')->nullable();
            $table->string('nilai_pembimbing')->nullable();
            $table->string('nilai_total')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_skripsis');
    }
};
