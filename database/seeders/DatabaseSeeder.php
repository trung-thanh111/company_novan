<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            TeamSeeder::class,
            PartnerSeeder::class,
            AchievementSeeder::class,
            FaqSeeder::class,
            ServiceSeeder::class,
            PostSeeder::class,
            ReviewSeeder::class,
            CoreValueSeeder::class,
            WorkProcessSeeder::class,
            ProjectCatalogueSeeder::class,
            ProjectSeeder::class,
        ]);
    }
}
