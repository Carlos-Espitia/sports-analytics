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

        $seasons = [
            [
                'api_league_id'   => 39,
                'api_season_year' => 2024,
                'name'            => 'Premier League 2024/25',
                'slug'            => 'premier-league-2024-25',
                'start_date'      => '2024-08-16',
                'end_date'        => '2025-05-25',
            ],
            [
                'api_league_id'   => 2,
                'api_season_year' => 2024,
                'name'            => 'UEFA Champions League 2024/25',
                'slug'            => 'champions-league-2024-25',
                'start_date'      => '2024-09-17',
                'end_date'        => '2025-05-31',
            ],
            [
                'api_league_id'   => 140,
                'api_season_year' => 2024,
                'name'            => 'La Liga 2024/25',
                'slug'            => 'la-liga-2024-25',
                'start_date'      => '2024-08-15',
                'end_date'        => '2025-05-25',
            ],
            [
                'api_league_id'   => 135,
                'api_season_year' => 2024,
                'name'            => 'Serie A 2024/25',
                'slug'            => 'serie-a-2024-25',
                'start_date'      => '2024-08-17',
                'end_date'        => '2025-05-25',
            ],
            [
                'api_league_id'   => 253,
                'api_season_year' => 2024,
                'name'            => 'MLS 2024',
                'slug'            => 'mls-2024',
                'start_date'      => '2024-02-21',
                'end_date'        => '2024-12-07',
            ],
        ];

        foreach ($seasons as $season) {
            Season::create(array_merge($season, ['sport_id' => $soccer->id]));
        }
    }
}
