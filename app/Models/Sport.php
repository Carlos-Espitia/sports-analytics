<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    public function seasons()
    {
        return $this->hasMany(Season::class);
    }

    public function players()
    {
        return $this->hasMany(Player::class);
    }
}
