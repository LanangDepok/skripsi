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
