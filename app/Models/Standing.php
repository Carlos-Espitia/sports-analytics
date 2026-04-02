<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Standing extends Model
{
    use HasFactory;

    protected $fillable = [
        'season_id', 'team_id', 'position', 'played', 'won',
        'drawn', 'lost', 'goals_for', 'goals_against', 'points',
    ];

    public function season()
    {
        return $this->belongsTo(Season::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function getGoalDifferenceAttribute(): int
    {
        return $this->goals_for - $this->goals_against;
    }
}
