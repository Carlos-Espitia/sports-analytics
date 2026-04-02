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
        Schema::create('match_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('match_id')->constrained()->cascadeOnDelete();
            $table->foreignId('team_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('possession')->nullable();
            $table->unsignedSmallInteger('shots')->nullable();
            $table->unsignedSmallInteger('shots_on_target')->nullable();
            $table->unsignedSmallInteger('corners')->nullable();
            $table->unsignedSmallInteger('fouls')->nullable();
            $table->unsignedTinyInteger('yellow_cards')->nullable();
            $table->unsignedTinyInteger('red_cards')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('match_stats');
    }
};
