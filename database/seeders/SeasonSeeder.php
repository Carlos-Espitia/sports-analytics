<?php

namespace Database\Seeders;

use App\Models\Season;
use App\Models\Sport;
use Illuminate\Database\Seeder;

class SeasonSeeder extends Seeder
{
    public function run(): void
    {
        $soccer = Sport::where('slug', 'soccer')->first();

        Season::create([
            'sport_id'   => $soccer->id,
            'name'       => 'Premier League 2024/25',
            'slug'       => 'premier-league-2024-25',
            'start_date' => '2024-08-16',
            'end_date'   => '2025-05-25',
        ]);
    }
}
