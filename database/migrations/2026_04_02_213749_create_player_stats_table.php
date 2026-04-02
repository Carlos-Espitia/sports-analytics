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
        Schema::create('player_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('match_id')->constrained()->cascadeOnDelete();
            $table->foreignId('player_id')->constrained()->cascadeOnDelete();
            $table->foreignId('team_id')->constrained()->cascadeOnDelete();
            $table->unsignedSmallInteger('minutes_played')->nullable();
            $table->unsignedTinyInteger('goals')->nullable();
            $table->unsignedTinyInteger('assists')->nullable();
            $table->unsignedTinyInteger('yellow_cards')->nullable();
            $table->unsignedTinyInteger('red_cards')->nullable();
            $table->unsignedSmallInteger('shots')->nullable();
            $table->unsignedSmallInteger('shots_on_target')->nullable();
            $table->unsignedSmallInteger('passes')->nullable();
            $table->decimal('pass_accuracy', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_stats');
    }
};
