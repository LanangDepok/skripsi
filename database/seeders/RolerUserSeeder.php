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
        $user1->roles()->sync([1]);

        $user2 = User::find(2);
        $user2->roles()->sync([2, 3, 4]);

        $user3 = User::find(3);
        $user3->roles()->sync([4]);

        $user4 = User::find(4);
        $user4->roles()->sync([4]);

        $user5 = User::find(5);
        $user5->roles()->sync([5]);

        $user6 = User::find(6);
        $user6->roles()->sync([3, 4, 5]);

        $user7 = User::find(7);
        $user7->roles()->sync([4, 5]);

        $user8 = User::find(8);
        $user8->roles()->sync([5]);

        $user9 = User::find(9);
        $user9->roles()->sync([2, 7]);

        $user10 = User::find(10);
        $user10->roles()->sync([6]);

        $user11 = User::find(11);
        $user11->roles()->sync([6]);

        $user12 = User::find(12);
        $user12->roles()->sync([6]);

        $user13 = User::find(13);
        $user13->roles()->sync([6]);

        $user14 = User::find(14);
        $user14->roles()->sync([6]);

        $user15 = User::find(15);
        $user15->roles()->sync([6]);

        $user16 = User::find(16);
        $user16->roles()->sync([6]);

        $user17 = User::find(17);
        $user17->roles()->sync([6]);

        $user18 = User::find(18);
        $user18->roles()->sync([6]);
    }
}
