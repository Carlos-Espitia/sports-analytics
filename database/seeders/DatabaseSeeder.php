<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Only seed the data the sync command needs to know what to fetch.
        // Teams, fixtures, standings, and stats all come from the API via football:sync.
        $this->call([
            SportSeeder::class,
            SeasonSeeder::class,
        ]);
    }
}
