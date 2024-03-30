<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolerUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = User::find(1);
        $user1->roles()->syncWithoutDetaching([1]);

        $user2 = User::find(2);
        $user2->roles()->syncWithoutDetaching([2, 3]);

        $user2 = User::find(3);
        $user2->roles()->syncWithoutDetaching([2, 4]);

        $user2 = User::find(3);
        $user2->roles()->syncWithoutDetaching([3, 4]);
    }
}
