<?php

namespace Database\Seeders;

use App\Models\Sport;
use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    public function run(): void
    {
        $soccer = Sport::where('slug', 'soccer')->first();

        $teams = [
            ['name' => 'Arsenal',              'short_name' => 'ARS', 'city' => 'London',      'country' => 'England'],
            ['name' => 'Chelsea',              'short_name' => 'CHE', 'city' => 'London',      'country' => 'England'],
            ['name' => 'Liverpool',            'short_name' => 'LIV', 'city' => 'Liverpool',   'country' => 'England'],
            ['name' => 'Manchester City',      'short_name' => 'MCI', 'city' => 'Manchester',  'country' => 'England'],
            ['name' => 'Manchester United',    'short_name' => 'MUN', 'city' => 'Manchester',  'country' => 'England'],
            ['name' => 'Tottenham Hotspur',    'short_name' => 'TOT', 'city' => 'London',      'country' => 'England'],
        ];

        foreach ($teams as $team) {
            Team::create(array_merge($team, ['sport_id' => $soccer->id]));
        }
    }
}
