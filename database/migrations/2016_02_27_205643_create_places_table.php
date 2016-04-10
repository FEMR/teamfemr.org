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


            $table->float('lat',8,5);
            $table->float('lng',8,5);
            $table->text('place');
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
        Schema::drop('places');



    }
}
