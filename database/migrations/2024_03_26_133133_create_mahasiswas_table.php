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
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('dospem_nip')->nullable();
            $table->bigInteger('nim')->unique();
            $table->string('prodi');
            $table->string('kelas');
            $table->string('status')->nullable();
            $table->string('tanda_tangan')->nullable();
            $table->string('photo_profil')->nullable();
            $table->string('file_skripsi')->nullable();
            $table->string('no_kontak')->nullable();
            $table->string('nama_ortu')->nullable();
            $table->string('no_kontak_ortu')->nullable();
            $table->string('tahun_ajaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
