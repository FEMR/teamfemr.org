<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitedLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visited_locations', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('outreach_program_id')->unsigned();
            $table->foreign('outreach_program_id')->references('id')->on('outreach_programs');

            $table->string('address');
            $table->string('address_ext')->nullable();
            $table->string('locality'); // city
            $table->string('administrative_area_level_1', 2); // state
            $table->string('administrative_area_level_2', 2)->nullable();
            $table->string('postal_code');
            $table->string('country');
            $table->decimal('latitude',11,8);
            $table->decimal('longitude',11,8);

            $table->date( 'start_date' )->nullable();
            $table->date( 'end_date' )->nullable();

            $table->timestamps();
            $table->softDeletes();
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
            $table->dropForeign(['outreach_program_id']);
        });
        Schema::drop('visited_locations');
    }
}
