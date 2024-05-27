<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'nama' => 'Admin'
        ]);
        Role::create([
            'nama' => 'Komite'
        ]);
        Role::create([
            'nama' => 'Ketua Penguji'
        ]);
        Role::create([
            'nama' => 'Dosen Penguji'
        ]);
        Role::create([
            'nama' => 'Dosen Pembimbing'
        ]);
        Role::create([
            'nama' => 'Mahasiswa'
        ]);
        Role::create([
            'nama' => 'Ketua Komite'
        ]);
    }
}
