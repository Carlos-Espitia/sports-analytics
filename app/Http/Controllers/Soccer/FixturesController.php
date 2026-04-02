<?php

namespace App\Http\Controllers\Soccer;

use App\Http\Controllers\Controller;
use App\Models\Fixture;
use App\Models\Season;
use Inertia\Inertia;

class FixturesController extends Controller
{
    public function index()
    {
        $season = Season::where('slug', 'premier-league-2024-25')->first();

        $fixtures = Fixture::with(['homeTeam', 'awayTeam'])
            ->where('season_id', $season->id)
            ->orderBy('match_date')
            ->get();

        return Inertia::render('Soccer/Fixtures', [
            'season'   => $season,
            'fixtures' => $fixtures,
        ]);
    }
}
