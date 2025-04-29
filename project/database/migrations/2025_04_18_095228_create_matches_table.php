<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->integer('team1_id');
            $table->integer('team2_id');
            $table->integer('winner_team')->nullable();
            $table->integer('loser_team')->nullable();
            $table->enum('status',['not_started','started','finished'])->default('not_started');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matches');
    }
};
