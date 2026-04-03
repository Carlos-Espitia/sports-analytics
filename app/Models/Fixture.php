<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fixture extends Model
{
    use HasFactory;

    // Tell Laravel this model uses the 'matches' table, not 'fixtures'
    protected $table = 'matches';

    protected $fillable = [
        'api_football_id', 'season_id', 'home_team_id', 'away_team_id',
        'match_date', 'status', 'home_score', 'away_score', 'venue',
    ];

    protected $casts = [
        'match_date' => 'datetime',
    ];

    public function season()
    {
        return $this->belongsTo(Season::class);
    }

    public function homeTeam()
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function awayTeam()
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }

    public function stats()
    {
        return $this->hasMany(MatchStat::class, 'match_id');
    }

    public function playerStats()
    {
        return $this->hasMany(PlayerStat::class, 'match_id');
    }
}
