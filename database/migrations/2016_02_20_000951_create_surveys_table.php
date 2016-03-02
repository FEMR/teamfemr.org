<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    //Create database of variables from the Trip Database survey (information regarding the medical teams and their trips)
    public function up()
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('teamname');
            $table->timestamp('initiated');
            $table->integer('totalmatriculants');
            $table->string('medschoolterms');
            $table->text('aidingschools');
            $table->text('totalperyear');
            $table->text('visitedlocale');
            $table->text('monthsoftravel'); // could be calculated from trip dates if used
            $table->text('partnerngo');
            $table->text('faculty');
            $table->text('appprocess');
            $table->text('programelements');
            $table->text('finsupport');
            $table->text('facultytimeallotted');
            $table->text('adminsupport');
            $table->text('contactinfo');
            $table->boolean('status');
            //$table->float('lat');
            //$table->float('lng');

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
        Schema::drop('surveys');
    }
}
