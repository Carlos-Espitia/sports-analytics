<?php

namespace Database\Seeders;

use App\Models\Fixture;
use App\Models\Season;
use App\Models\Team;
use Illuminate\Database\Seeder;

class FixtureSeeder extends Seeder
{
    public function run(): void
    {
        $season = Season::where('slug', 'premier-league-2024-25')->first();

        $teams = Team::whereHas('sport', fn($q) => $q->where('slug', 'soccer'))
            ->pluck('id', 'short_name');

        $fixtures = [
            ['home' => 'ARS', 'away' => 'CHE', 'date' => '2024-08-25 15:00:00', 'home_score' => 2, 'away_score' => 1],
            ['home' => 'LIV', 'away' => 'MUN', 'date' => '2024-08-25 17:30:00', 'home_score' => 3, 'away_score' => 0],
            ['home' => 'MCI', 'away' => 'TOT', 'date' => '2024-08-25 20:00:00', 'home_score' => 1, 'away_score' => 1],
            ['home' => 'CHE', 'away' => 'LIV', 'date' => '2024-09-01 15:00:00', 'home_score' => 0, 'away_score' => 2],
            ['home' => 'MUN', 'away' => 'ARS', 'date' => '2024-09-01 17:30:00', 'home_score' => 1, 'away_score' => 3],
            ['home' => 'TOT', 'away' => 'MCI', 'date' => '2024-09-01 20:00:00', 'home_score' => 2, 'away_score' => 2],
            ['home' => 'ARS', 'away' => 'LIV', 'date' => '2024-09-15 16:30:00', 'home_score' => 1, 'away_score' => 1],
            ['home' => 'MCI', 'away' => 'CHE', 'date' => '2024-09-15 14:00:00', 'home_score' => 3, 'away_score' => 1],
            ['home' => 'MUN', 'away' => 'TOT', 'date' => '2024-09-22 14:00:00', 'home_score' => 0, 'away_score' => 2],
            ['home' => 'LIV', 'away' => 'ARS', 'date' => '2024-10-20 16:30:00', 'home_score' => null, 'away_score' => null],
        ];

        foreach ($fixtures as $fixture) {
            Fixture::create([
                'season_id'    => $season->id,
                'home_team_id' => $teams[$fixture['home']],
                'away_team_id' => $teams[$fixture['away']],
                'match_date'   => $fixture['date'],
                'status'       => is_null($fixture['home_score']) ? 'scheduled' : 'finished',
                'home_score'   => $fixture['home_score'],
                'away_score'   => $fixture['away_score'],
                'venue'        => null,
            ]);
        }
    }
}
