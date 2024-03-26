<?php

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Dosen::create([
            'user_id' => '2',
            'nip' => '123',
            'jabatan' => 'jabatan dosen',
            'fungsional' => 'fungsional dosen',
            'gol_pangkat' => 'gol dan pangkat dosen',
            'tanda_tangan' => ''
        ]);
        Dosen::create([
            'user_id' => '3',
            'nip' => '234',
            'jabatan' => 'jabatan dosen',
            'fungsional' => 'fungsional dosen',
            'gol_pangkat' => 'gol dan pangkat dosen',
            'tanda_tangan' => ''
        ]);
        Dosen::create([
            'user_id' => '4',
            'nip' => '345',
            'jabatan' => 'jabatan dosen',
            'fungsional' => 'fungsional dosen',
            'gol_pangkat' => 'gol dan pangkat dosen',
            'tanda_tangan' => ''
        ]);
        Dosen::create([
            'user_id' => '5',
            'nip' => '456',
            'jabatan' => 'jabatan dosen',
            'fungsional' => 'fungsional dosen',
            'gol_pangkat' => 'gol dan pangkat dosen',
            'tanda_tangan' => ''
        ]);
    }
}
