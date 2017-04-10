<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema built to work with:
        // * Countries - http://data.okfn.org/data/core/country-codes
        // * Cities - https://www.maxmind.com/en/free-world-cities-database

        Schema::create('countries', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->string('official_name_en');
            $table->string('official_name_fr');
            $table->string('slug')->unique();
            $table->string('code_2', 2);
            $table->string('code_3', 3);
            $table->integer('population');
            $table->string('capital');
            $table->string('continent');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('cities', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('country_id')->unsigned();
            $table->foreign('country_id')->references('id')->on('countries');
            $table->string('name');
            $table->string('name_accents');
            $table->string('slug')->unique();
            $table->integer('population');
            $table->decimal('latitude',11,8);
            $table->decimal('longitude',11,8);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('postals', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('country_id')->unsigned();
            $table->foreign('country_id')->references('id')->on('countries');
            $table->integer('city_id')->unsigned();
            $table->foreign('city_id')->references('id')->on('cities');
            $table->string('code');
            $table->integer('population');
            $table->decimal('latitude',11,8);
            $table->decimal('longitude',11,8);
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
        Schema::table('postals', function (Blueprint $table)
        {
            $table->dropForeign(['city_id']);
            $table->dropForeign(['country_id']);
        });
        Schema::drop('postals');
        
        Schema::table('cities', function (Blueprint $table)
        {
            $table->dropForeign(['country_id']);
        });
        Schema::drop('cities');


        Schema::drop('countries');
    }
}
