<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterVisitedLocationsTableIncreaseAdminAreaSize extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('visited_locations', function (Blueprint $table)
        {
            $table->string('administrative_area_level_1', 255)->change();
            $table->string('administrative_area_level_2', 255)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('visited_locations', function (Blueprint $table)
        {
            $table->string('administrative_area_level_1', 2)->change();
            $table->string('administrative_area_level_2', 2)->change();
        });
    }
}
