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
        Schema::create('standings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('season_id')->constrained()->cascadeOnDelete();
            $table->foreignId('team_id')->constrained()->cascadeOnDelete();
            $table->unsignedSmallInteger('position')->default(0);
            $table->unsignedSmallInteger('played')->default(0);
            $table->unsignedSmallInteger('won')->default(0);
            $table->unsignedSmallInteger('drawn')->default(0);
            $table->unsignedSmallInteger('lost')->default(0);
            $table->unsignedSmallInteger('goals_for')->default(0);
            $table->unsignedSmallInteger('goals_against')->default(0);
            $table->unsignedSmallInteger('points')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('standings');
    }
};
