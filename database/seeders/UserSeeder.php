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
            'name' => 'admin',
            'password' => 'admintik',
        ]);
        User::create([
            'email' => 'eriya@gmail.com',
            'name' => 'Eriya, S.Kom., M.T.',
            'password' => 'bueriya',
        ]);
        User::create([
            'email' => 'euis@gmail.com',
            'name' => 'Euis Oktavianti, S.Si., M.T.I.',
            'password' => 'bueuis',
        ]);
        User::create([
            'email' => 'anita@gmail.com',
            'name' => 'Dr. Anita Hidayati, S.Kom., M.Kom',
            'password' => 'buanita',
        ]);
        User::create([
            'email' => 'anggi@gmail.com',
            'name' => 'Anggi Mardiyono, S.Kom., M.Kom.',
            'password' => 'pakanggi',
        ]);
        User::create([
            'email' => 'bagas@gmail.com',
            'name' => 'Bagas',
            'password' => 'bagas',
        ]);
        User::create([
            'email' => 'rizki@gmail.com',
            'name' => 'Rizki',
            'password' => 'rizki',
        ]);
    }
}
