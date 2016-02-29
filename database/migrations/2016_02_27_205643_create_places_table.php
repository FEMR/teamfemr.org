<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->increments('id');

//            $table->integer('survey_id')->unsigned();
//
//
//            $table->foreign('survey_id')
//                ->references('id')
//                ->on('surveys')
//                ->onDelete('cascade');


            $table->double('lat');
            $table->double('lng');
            $table->timestamps();


        });

        Schema::create('place_survey', function(Blueprint $table)
        {
            $table->integer('survey_id')->unsigned();
            $table->foreign('survey_id')->references('id')
                ->on('surveys')->onDelete('cascade');

            $table->integer('place_id')->unsigned();
            $table->foreign('place_id')->references('id')
                ->on('places')->onDelete('cascade');

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
        Schema::drop('place_survey');
        Schema::drop('places');



    }
}
