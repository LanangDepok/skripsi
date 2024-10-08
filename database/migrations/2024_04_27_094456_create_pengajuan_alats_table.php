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
        Schema::create('pengajuan_alats', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->text('f12');
            $table->text('f13');
            $table->text('f14');
            $table->text('bebas_perpustakaan');
            $table->text('sertifikat_toeic');
            $table->text('sertifikat_prestasi');
            $table->text('sertifikat_pkkp');
            $table->text('sertifikat_organisasi')->nullable();
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
        Schema::dropIfExists('pengajuan_alats');
    }
};
