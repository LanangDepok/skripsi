<?php

namespace Database\Seeders;

use App\Models\Konten;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KontenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Konten::create([
            'nama' => 'timeline_skripsi',
            'gambar' => 'konten/timeline_skripsi.jpg',
        ]);

        Konten::create([
            'nama' => 'alur_skripsi',
            'gambar' => 'konten/alur_skripsi.jpg',
        ]);
    }
}
