<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('seasons', function (Blueprint $table) {
            $table->unsignedInteger('api_league_id')->nullable()->after('sport_id');
            $table->unsignedSmallInteger('api_season_year')->nullable()->after('api_league_id');
        });
    }

    public function down(): void
    {
        Schema::table('seasons', function (Blueprint $table) {
            $table->dropColumn(['api_league_id', 'api_season_year']);
        });
    }
};
