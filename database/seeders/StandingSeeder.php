<?php

namespace Database\Seeders;

use App\Models\Season;
use App\Models\Standing;
use App\Models\Team;
use Illuminate\Database\Seeder;

class StandingSeeder extends Seeder
{
    public function run(): void
    {
        $season = Season::where('slug', 'premier-league-2024-25')->first();
        $teams  = Team::whereHas('sport', fn($q) => $q->where('slug', 'soccer'))
            ->pluck('id', 'short_name');

        // Standings based on the fixtures seeded above
        $standings = [
            ['short_name' => 'LIV', 'position' => 1, 'played' => 3, 'won' => 3, 'drawn' => 0, 'lost' => 0, 'goals_for' => 7, 'goals_against' => 1, 'points' => 9],
            ['short_name' => 'ARS', 'position' => 2, 'played' => 3, 'won' => 2, 'drawn' => 1, 'lost' => 0, 'goals_for' => 6, 'goals_against' => 2, 'points' => 7],
            ['short_name' => 'TOT', 'position' => 3, 'played' => 3, 'won' => 1, 'drawn' => 2, 'lost' => 0, 'goals_for' => 5, 'goals_against' => 3, 'points' => 5],
            ['short_name' => 'MCI', 'position' => 4, 'played' => 3, 'won' => 1, 'drawn' => 1, 'lost' => 1, 'goals_for' => 5, 'goals_against' => 4, 'points' => 4],
            ['short_name' => 'CHE', 'position' => 5, 'played' => 3, 'won' => 0, 'drawn' => 0, 'lost' => 3, 'goals_for' => 2, 'goals_against' => 7, 'points' => 0],
            ['short_name' => 'MUN', 'position' => 6, 'played' => 3, 'won' => 0, 'drawn' => 0, 'lost' => 3, 'goals_for' => 1, 'goals_against' => 8, 'points' => 0],
        ];

        foreach ($standings as $row) {
            Standing::create([
                'season_id'      => $season->id,
                'team_id'        => $teams[$row['short_name']],
                'position'       => $row['position'],
                'played'         => $row['played'],
                'won'            => $row['won'],
                'drawn'          => $row['drawn'],
                'lost'           => $row['lost'],
                'goals_for'      => $row['goals_for'],
                'goals_against'  => $row['goals_against'],
                'points'         => $row['points'],
            ]);
        }
    }
}
