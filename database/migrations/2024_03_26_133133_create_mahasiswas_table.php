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
            $table->integer('user_id');
            $table->integer('dospem_nip')->nullable();
            $table->integer('nim')->unique();
            $table->string('prodi');
            $table->string('kelas');
            $table->string('status')->nullable();
            $table->string('tanda_tangan')->nullable();
            $table->string('file_skripsi')->nullable();
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
