<?php

namespace Database\Seeders;

use App\Models\User;
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
        // for ($i=1; $i <= 50 ; $i++) {
            $user = [
                'name' => 'test',
                'email' => 'test@gmail.com',
                'file' => 'https://i.pravatar.cc/160?img=1',
                'password' => 'test1234',
            ];
            DB::table('users')->insert($user);
        // }
    }
}