<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique();

            // Trying to build address fields for global addresses
            $table->string('address');
            $table->string('address_ext')->nullable();
            $table->string('locality'); // city
            $table->string('administrative_area_level_1', 2); // state
            $table->string('administrative_area_level_2', 2)->nullable();
            $table->string('postal_code');
            $table->string('country');
            $table->decimal('latitude',11,8);
            $table->decimal('longitude',11,8);

            $table->text('notes')->nullable();
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
        Schema::drop('schools');
    }
}
