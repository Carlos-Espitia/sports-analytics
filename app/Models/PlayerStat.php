<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerStat extends Model
{
    use HasFactory;

    protected $fillable = [
        'match_id', 'player_id', 'team_id', 'minutes_played', 'goals',
        'assists', 'yellow_cards', 'red_cards', 'shots', 'shots_on_target',
        'passes', 'pass_accuracy',
    ];

    public function fixture()
    {
        return $this->belongsTo(Fixture::class, 'match_id');
    }

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
