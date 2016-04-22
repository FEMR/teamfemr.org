<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTitleImageDescriptionToLiteraturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('literatures', function (Blueprint $table) {
            $table->text('title');
            $table->text('imageUrl');
            $table->text('description');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('literatures', function (Blueprint $table) {
            
        });
    }
}
