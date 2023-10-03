<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FeedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        for ($i=1; $i <= 50 ; $i++) {
            $feed = [
            'title' => Str::random(10),
                'name' =>  'User'. $i,
                'caption' => Str::random(20),
                'like' => 10,
                'comment' => 10,
                'saved' => 10,
            ];
            DB::table('feeds')->insert($feed);
        }
    }
}
