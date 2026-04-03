<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    protected $fillable = ['sport_id', 'api_league_id', 'api_season_year', 'name', 'slug', 'start_date', 'end_date'];

    public function sport()
    {
        return $this->belongsTo(Sport::class);
    }

    public function fixtures()
    {
        return $this->hasMany(Fixture::class);
    }

    public function standings()
    {
        return $this->hasMany(Standing::class);
    }
}
