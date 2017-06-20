<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSchoolsAddHasTrips extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schools', function( Blueprint $table )
        {
            $table->boolean( 'has_trips' )->default( false )->after('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schools', function( Blueprint $table )
        {
            $table->dropColumn( 'has_trips' );
        });
    }
}
