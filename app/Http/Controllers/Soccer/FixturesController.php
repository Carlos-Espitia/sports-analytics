<?php

namespace App\Http\Controllers\Soccer;

use App\Http\Controllers\Controller;
use App\Models\Fixture;
use App\Models\Season;
use Inertia\Inertia;

class FixturesController extends Controller
{
    public function index(string $season)
    {
        $season = Season::where('slug', $season)->firstOrFail();

        $fixtures = Fixture::with(['homeTeam', 'awayTeam'])
            ->where('season_id', $season->id)
            ->orderBy('match_date')
            ->get();

        $seasons = Season::whereHas('sport', fn($q) => $q->where('slug', 'soccer'))
            ->orderBy('name')
            ->get(['id', 'name', 'slug']);

        return Inertia::render('Soccer/Fixtures', [
            'season'   => $season,
            'fixtures' => $fixtures,
            'seasons'  => $seasons,
        ]);
    }
}
