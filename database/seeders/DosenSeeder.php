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
            'jabatan' => 'Jabatan 1',
            'fungsional' => 'Fungsional 1',
            'gol_pangkat' => 'gol_pangkat 1',
            'tanda_tangan' => '',
        ]);
        Dosen::create([
            'user_id' => '3',
            'nip' => '234',
            'jabatan' => 'Jabatan 2',
            'fungsional' => 'Fungsional 2',
            'gol_pangkat' => 'gol_pangkat 2',
            'tanda_tangan' => '',
        ]);
        Dosen::create([
            'user_id' => '4',
            'nip' => '345',
            'jabatan' => 'Jabatan 3',
            'fungsional' => 'Fungsional 3',
            'gol_pangkat' => 'gol_pangkat 3',
            'tanda_tangan' => '',
        ]);
        Dosen::create([
            'user_id' => '5',
            'nip' => '3454738473',
            'jabatan' => 'Jabatan 3',
            'fungsional' => 'Fungsional 3',
            'gol_pangkat' => 'gol_pangkat 3',
            'tanda_tangan' => '',
        ]);
        Dosen::create([
            'user_id' => '6',
            'nip' => '1341234',
            'jabatan' => 'Jabatan 1',
            'fungsional' => 'Fungsional 1',
            'gol_pangkat' => 'gol_pangkat 1',
            'tanda_tangan' => '',
        ]);
        Dosen::create([
            'user_id' => '7',
            'nip' => '134134',
            'jabatan' => 'Jabatan 1',
            'fungsional' => 'Fungsional 1',
            'gol_pangkat' => 'gol_pangkat 1',
            'tanda_tangan' => '',
        ]);
        Dosen::create([
            'user_id' => '8',
            'nip' => '1341414',
            'jabatan' => 'Jabatan 1',
            'fungsional' => 'Fungsional 1',
            'gol_pangkat' => 'gol_pangkat 1',
            'tanda_tangan' => '',
        ]);
        Dosen::create([
            'user_id' => '9',
            'nip' => '1341515',
            'jabatan' => 'Jabatan 1',
            'fungsional' => 'Fungsional 1',
            'gol_pangkat' => 'gol_pangkat 1',
            'tanda_tangan' => '',
        ]);
    }
}
