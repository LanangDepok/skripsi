<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'email' => 'admintik',
            'nama' => 'admin',
            'password' => '1#4g$5_1@!zl<1y4nT0',
        ]);
        // User::create([
        //     'email' => 'eriya@gmail.com',
        //     'nama' => 'Eriya, S.Kom., M.T.',
        //     'password' => 'bueriya',
        // ]);
        // User::create([
        //     'email' => 'euis@gmail.com',
        //     'nama' => 'Euis Oktavianti, S.Si., M.T.I.',
        //     'password' => 'bueuis',
        // ]);
        // User::create([
        //     'email' => 'anita@gmail.com',
        //     'nama' => 'Dr. Anita Hidayati, S.Kom., M.Kom',
        //     'password' => 'buanita',
        // ]);
        // User::create([
        //     'email' => 'anggi@gmail.com',
        //     'nama' => 'Anggi Mardiyono, S.Kom., M.Kom.',
        //     'password' => 'pakanggi',
        // ]);
        // User::create([
        //     'email' => 'bambang@gmail.com',
        //     'nama' => 'Pak Bambang',
        //     'password' => 'pakbambang',
        // ]);
        // User::create([
        //     'email' => 'mauldy@gmail.com',
        //     'nama' => 'Pak mauldy',
        //     'password' => 'pakmauldy',
        // ]);
        // User::create([
        //     'email' => 'asep@gmail.com',
        //     'nama' => 'Pak Asep',
        //     'password' => 'pakasep',
        // ]);
        // User::create([
        //     'email' => 'hatta@gmail.com',
        //     'nama' => 'Pak Hatta',
        //     'password' => 'pakhatta',
        // ]);

        // User::create([
        //     'email' => 'bagas@gmail.com',
        //     'nama' => 'Bagas',
        //     'password' => 'bagas',
        // ]);
        // User::create([
        //     'email' => 'rizki@gmail.com',
        //     'nama' => 'Rizki',
        //     'password' => 'rizki',
        // ]);
        // User::create([
        //     'email' => 'yanto@gmail.com',
        //     'nama' => 'Yanto',
        //     'password' => 'yanto',
        // ]);
        // User::create([
        //     'email' => 'fillea@gmail.com',
        //     'nama' => 'Fillea',
        //     'password' => 'fillea',
        // ]);
        // User::create([
        //     'email' => 'rethia@gmail.com',
        //     'nama' => 'Rethia',
        //     'password' => 'rethia',
        // ]);
        // User::create([
        //     'email' => 'yuma@gmail.com',
        //     'nama' => 'Yuma',
        //     'password' => 'yuma',
        // ]);
        // User::create([
        //     'email' => 'gladys@gmail.com',
        //     'nama' => 'Gladys',
        //     'password' => 'gladys',
        // ]);
        // User::create([
        //     'email' => 'aisha@gmail.com',
        //     'nama' => 'Aisha',
        //     'password' => 'aisha',
        // ]);
        // User::create([
        //     'email' => 'rizkita@gmail.com',
        //     'nama' => 'Rizkita',
        //     'password' => 'rizkita',
        // ]);
    }
}
