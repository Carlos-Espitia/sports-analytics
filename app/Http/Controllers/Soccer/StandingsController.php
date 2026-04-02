<?php

namespace App\Http\Controllers\Soccer;

use App\Http\Controllers\Controller;
use App\Models\Season;
use App\Models\Standing;
use Inertia\Inertia;

class StandingsController extends Controller
{
    public function index()
    {
        $season = Season::where('slug', 'premier-league-2024-25')->first();

        $standings = Standing::with('team')
            ->where('season_id', $season->id)
            ->orderBy('position')
            ->get();

        return Inertia::render('Soccer/Standings', [
            'season'    => $season,
            'standings' => $standings,
        ]);
    }
}
