<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = ['api_football_id', 'team_id', 'sport_id', 'name', 'position', 'nationality', 'date_of_birth', 'jersey_number'];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function sport()
    {
        return $this->belongsTo(Sport::class);
    }

    public function stats()
    {
        return $this->hasMany(PlayerStat::class);
    }
}
