<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['sport_id', 'name', 'short_name', 'logo_url', 'country', 'city'];

    public function sport()
    {
        return $this->belongsTo(Sport::class);
    }

    public function players()
    {
        return $this->hasMany(Player::class);
    }

    public function standings()
    {
        return $this->hasMany(Standing::class);
    }

    public function homeFixtures()
    {
        return $this->hasMany(Fixture::class, 'home_team_id');
    }

    public function awayFixtures()
    {
        return $this->hasMany(Fixture::class, 'away_team_id');
    }
}
