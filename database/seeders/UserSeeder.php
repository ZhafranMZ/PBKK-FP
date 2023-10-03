<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 50 ; $i++) {
            $user = [
                'name' => 'TestUser'.$i,
                'email' => 'TestUser' . $i . '@gmail.com',
                'profile_pic' => 'https://i.pravatar.cc/160?img=' . $i,
                'password' => 'TestUser'.$i,
                'follower' => $i,
                'following' => $i,
            ];
            DB::table('users')->insert($user);
        }
    }
}