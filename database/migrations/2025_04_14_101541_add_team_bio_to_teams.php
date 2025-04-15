<?php

use Dom\Text;
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
        Schema::table('teams', function (Blueprint $table) {
          $table->string('name')->after('team_captain');
          $table->string('photo')->nullable()->after('name');
          $table->text('team_bio')->after('photo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->dropColumn('team_bio');
            $table->dropColumn('name');
            $table->dropColumn('photo');
        });
    }
};
