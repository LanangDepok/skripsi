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
            $table->text('sertifikat_lomba');
            $table->string('status');
            $table->string('tanggal')->nullable();
            $table->string('nilai1')->nullable();
            $table->string('nilai2')->nullable();
            $table->string('nilai3')->nullable();
            $table->string('nilai_pembimbing')->nullable();
            $table->string('nilai_total')->nullable();
            $table->string('acc_dospem')->nullable();
            $table->string('4a1')->nullable();
            $table->string('4a2')->nullable();
            $table->string('4a3')->nullable();
            $table->string('4b1')->nullable();
            $table->string('4b2')->nullable();
            $table->string('4b3')->nullable();
            $table->string('4b4')->nullable();
            $table->string('4c1')->nullable();
            $table->string('4c2')->nullable();
            $table->string('4c3')->nullable();
            $table->string('4c4')->nullable();
            $table->string('1a1')->nullable();
            $table->string('1a2')->nullable();
            $table->string('1a3')->nullable();
            $table->string('1b1')->nullable();
            $table->string('1b2')->nullable();
            $table->string('1b3')->nullable();
            $table->string('1b4')->nullable();
            $table->string('1b5')->nullable();
            $table->string('2a1')->nullable();
            $table->string('2a2')->nullable();
            $table->string('2a3')->nullable();
            $table->string('2b1')->nullable();
            $table->string('2b2')->nullable();
            $table->string('2b3')->nullable();
            $table->string('2b4')->nullable();
            $table->string('2b5')->nullable();
            $table->string('3a1')->nullable();
            $table->string('3a2')->nullable();
            $table->string('3a3')->nullable();
            $table->string('3b1')->nullable();
            $table->string('3b2')->nullable();
            $table->string('3b3')->nullable();
            $table->string('3b4')->nullable();
            $table->string('3b5')->nullable();
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
