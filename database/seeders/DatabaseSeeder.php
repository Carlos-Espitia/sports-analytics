<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Order matters — each seeder depends on the previous one's data
        $this->call([
            SportSeeder::class,
            TeamSeeder::class,
            SeasonSeeder::class,
            FixtureSeeder::class,
            StandingSeeder::class,
        ]);
    }
}
