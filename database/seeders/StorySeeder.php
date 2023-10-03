<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=1; $i <= 50 ; $i++) {
            $story = [
                'title' => Str::random(20),
                'like' => 10,
            ];
            DB::table('stories')->insert($story);
        }
    }
}
