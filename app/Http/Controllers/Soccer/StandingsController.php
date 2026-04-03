<?php

namespace App\Http\Controllers\Soccer;

use App\Http\Controllers\Controller;
use App\Models\Season;
use App\Models\Standing;
use Inertia\Inertia;

class StandingsController extends Controller
{
    public function index(string $season)
    {
        $season = Season::where('slug', $season)->firstOrFail();

        $standings = Standing::with('team')
            ->where('season_id', $season->id)
            ->orderBy('position')
            ->get();

        $seasons = Season::whereHas('sport', fn($q) => $q->where('slug', 'soccer'))
            ->orderBy('name')
            ->get(['id', 'name', 'slug']);

        return Inertia::render('Soccer/Standings', [
            'season'    => $season,
            'standings' => $standings,
            'seasons'   => $seasons,
        ]);
    }
}
