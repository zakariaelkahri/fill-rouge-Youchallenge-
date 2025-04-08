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
        Schema::create('tournaments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organisator_id')->constrained('organisators');
            $table->string('name');
            $table->string('photo')->nullable();
            $table->enum('format',['FC25','VALORANT','CSGO']);
            $table->string('max_participants');
            $table->text('reward')->nullable();
            $table->text('rules')->nullable();
            $table->enum('status',['upcoming','ongoing','completed'])->default('upcoming');
            $table->boolean('deleted')->default(0);
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->timestamps();
            
        });
//  - tournament_id: int
// - name: string
// - photo: string
// - format: string
// - start_date: Date
// - end_date: Date
// - max_participants: int
// - status: string
// - reward: string
// - rules: string
// -deleted:bool
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tournaments');
    }
};
