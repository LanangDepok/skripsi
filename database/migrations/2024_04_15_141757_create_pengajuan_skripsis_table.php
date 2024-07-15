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
            $table->bigInteger('dospem2_id')->nullable();
            $table->bigInteger('penguji1_id')->nullable();
            $table->bigInteger('penguji2_id')->nullable();
            $table->bigInteger('penguji3_id')->nullable();
            $table->text('link_presentasi');
            $table->text('sertifikat_lomba');
            $table->string('status');
            $table->string('tanggal')->nullable();
            $table->string('tanggal_lulus')->nullable();
            $table->string('acc_dospem')->nullable();
            $table->double('nilai1')->nullable();
            $table->double('nilai2')->nullable();
            $table->double('nilai3')->nullable();
            $table->double('nilai_pembimbing')->nullable();
            $table->double('nilai_pembimbing2')->nullable();
            $table->double('nilai_total')->nullable();
            $table->string('nilai_mutu')->nullable();
            $table->double('4a1')->nullable();
            $table->double('4a2')->nullable();
            $table->double('4a3')->nullable();
            $table->double('4b1')->nullable();
            $table->double('4b2')->nullable();
            $table->double('4b3')->nullable();
            $table->double('4b4')->nullable();
            $table->double('4c1')->nullable();
            $table->double('4c2')->nullable();
            $table->double('4c3')->nullable();
            $table->double('4c4')->nullable();
            $table->double('5a1')->nullable();
            $table->double('5a2')->nullable();
            $table->double('5a3')->nullable();
            $table->double('5b1')->nullable();
            $table->double('5b2')->nullable();
            $table->double('5b3')->nullable();
            $table->double('5b4')->nullable();
            $table->double('5c1')->nullable();
            $table->double('5c2')->nullable();
            $table->double('5c3')->nullable();
            $table->double('5c4')->nullable();
            $table->double('1a1')->nullable();
            $table->double('1a2')->nullable();
            $table->double('1a3')->nullable();
            $table->double('1b1')->nullable();
            $table->double('1b2')->nullable();
            $table->double('1b3')->nullable();
            $table->double('1b4')->nullable();
            $table->double('1b5')->nullable();
            $table->double('2a1')->nullable();
            $table->double('2a2')->nullable();
            $table->double('2a3')->nullable();
            $table->double('2b1')->nullable();
            $table->double('2b2')->nullable();
            $table->double('2b3')->nullable();
            $table->double('2b4')->nullable();
            $table->double('2b5')->nullable();
            $table->double('3a1')->nullable();
            $table->double('3a2')->nullable();
            $table->double('3a3')->nullable();
            $table->double('3b1')->nullable();
            $table->double('3b2')->nullable();
            $table->double('3b3')->nullable();
            $table->double('3b4')->nullable();
            $table->double('3b5')->nullable();
            $table->bigInteger('pengizin')->nullable();
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
