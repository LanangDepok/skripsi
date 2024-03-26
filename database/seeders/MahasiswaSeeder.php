<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mahasiswa::create([
            'user_id' => 6,
            'dospem_nip' => 456,
            'nim' => 207412006,
            'prodi' => 'Teknik Informatika',
            'kelas' => 'TI_CCIT 8',
            'status' => 'Bimbingan sempro',
            'tanda_tangan' => '',
            'file_skripsi' => '',
            'tahun_ajaran' => '2023/2024'
        ]);
        Mahasiswa::create([
            'user_id' => 7,
            'dospem_nip' => 456,
            'nim' => 207412007,
            'prodi' => 'Teknik Informatika',
            'kelas' => 'TI_CCIT 8',
            'status' => '',
            'tanda_tangan' => '',
            'file_skripsi' => '',
            'tahun_ajaran' => '2023/2024'
        ]);
    }
}
