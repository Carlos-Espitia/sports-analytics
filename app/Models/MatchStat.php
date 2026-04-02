<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchStat extends Model
{
    use HasFactory;

    protected $fillable = [
        'match_id', 'team_id', 'possession', 'shots', 'shots_on_target',
        'corners', 'fouls', 'yellow_cards', 'red_cards',
    ];

    public function fixture()
    {
        return $this->belongsTo(Fixture::class, 'match_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
