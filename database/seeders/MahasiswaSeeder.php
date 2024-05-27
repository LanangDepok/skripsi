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
            'user_id' => 10,
            'nim' => 207412006,
            'prodi' => 'Teknik Informatika',
            'kelas' => 'TI_CCIT 8',
            'status' => 'Belum mengajukan judul',
            'tanda_tangan' => '',
            'tahun_ajaran' => '2023/2024'
        ]);
        Mahasiswa::create([
            'user_id' => 11,
            'nim' => 207412007,
            'prodi' => 'Teknik Informatika',
            'kelas' => 'TI_CCIT 8',
            'status' => 'Belum mengajukan judul',
            'tanda_tangan' => '',
            'tahun_ajaran' => '2023/2024'
        ]);
        Mahasiswa::create([
            'user_id' => 12,
            'nim' => 207412008,
            'prodi' => 'Teknik Informatika',
            'kelas' => 'TI_CCIT 8',
            'status' => 'Belum mengajukan judul',
            'tanda_tangan' => '',
            'tahun_ajaran' => '2023/2024'
        ]);
        Mahasiswa::create([
            'user_id' => 13,
            'nim' => 207412009,
            'prodi' => 'Teknik Multimedia dan Jaringan',
            'kelas' => 'TI_CCIT 8',
            'status' => 'Belum mengajukan judul',
            'tanda_tangan' => '',
            'tahun_ajaran' => '2023/2024'
        ]);
        Mahasiswa::create([
            'user_id' => 14,
            'nim' => 207412010,
            'prodi' => 'Teknik Multimedia dan Jaringan',
            'kelas' => 'TI_CCIT 8',
            'status' => 'Belum mengajukan judul',
            'tanda_tangan' => '',
            'tahun_ajaran' => '2023/2024'
        ]);
        Mahasiswa::create([
            'user_id' => 15,
            'nim' => 207412011,
            'prodi' => 'Teknik Multimedia dan Jaringan',
            'kelas' => 'TI_CCIT 8',
            'status' => 'Belum mengajukan judul',
            'tanda_tangan' => '',
            'tahun_ajaran' => '2023/2024'
        ]);
        Mahasiswa::create([
            'user_id' => 16,
            'nim' => 207412012,
            'prodi' => 'Teknik Multimedia Digital',
            'kelas' => 'TI_CCIT 8',
            'status' => 'Belum mengajukan judul',
            'tanda_tangan' => '',
            'tahun_ajaran' => '2023/2024'
        ]);
        Mahasiswa::create([
            'user_id' => 17,
            'nim' => 207412013,
            'prodi' => 'Teknik Multimedia Digital',
            'kelas' => 'TI_CCIT 8',
            'status' => 'Belum mengajukan judul',
            'tanda_tangan' => '',
            'tahun_ajaran' => '2023/2024'
        ]);
        Mahasiswa::create([
            'user_id' => 18,
            'nim' => 207412014,
            'prodi' => 'Teknik Multimedia Digital',
            'kelas' => 'TI_CCIT 8',
            'status' => 'Belum mengajukan judul',
            'tanda_tangan' => '',
            'tahun_ajaran' => '2023/2024'
        ]);
    }
}
