<?php

namespace Database\Seeders;

use App\Models\Sport;
use Illuminate\Database\Seeder;

class SportSeeder extends Seeder
{
    public function run(): void
    {
        Sport::create(['name' => 'Soccer', 'slug' => 'soccer']);
    }
}
