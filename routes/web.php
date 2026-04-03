<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Soccer\StandingsController;
use App\Http\Controllers\Soccer\FixturesController;

Route::get('/', function () {
    return Inertia::render('Home', [
        'message' => 'Laravel + Inertia + React is working.',
    ]);
});

Route::prefix('soccer')->name('soccer.')->group(function () {
    Route::get('/standings/{season}', [StandingsController::class, 'index'])->name('standings');
    Route::get('/fixtures/{season}', [FixturesController::class, 'index'])->name('fixtures');
});
