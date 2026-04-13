<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('languages')->insert([
            [
                'name' => 'Vietnamese',
                'canonical' => 'vn',
                'publish' => 2,
                'user_id' => 1,
                'image' => '/vendor/backend/img/vn.png',
                'current' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'English',
                'canonical' => 'en',
                'publish' => 2,
                'user_id' => 1,
                'image' => '/vendor/backend/img/en.png',
                'current' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
