<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiteraturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    //Create database of literature resources, using the data from the Literature Bank survey
    public function up()
    {
        Schema::create('literatures', function (Blueprint $table) {
            $table->increments('id');
            $table->text('contributorName');
            $table->text('authorName');
            $table->text('addLink');
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
        Schema::drop('literatures');
    }
}
