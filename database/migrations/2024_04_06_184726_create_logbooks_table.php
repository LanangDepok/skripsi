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
        Schema::create('logbooks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('bimbingan_id');
            $table->string('pengizin')->nullable();
            $table->string('tanggal')->nullable();
            $table->string('tempat')->nullable();
            $table->text('uraian')->nullable();
            $table->text('rencana_pencapaian')->nullable();
            $table->enum('jenis_bimbingan', ['Proposal', 'Skripsi'])->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logbooks');
    }
};
