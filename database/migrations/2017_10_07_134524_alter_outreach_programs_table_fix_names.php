<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOutreachProgramsTableFixNames extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table( 'outreach_programs', function( Blueprint $table )
        {
            $table->string( 'school_name' )->after( 'name' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table( 'outreach_programs', function( Blueprint $table )
        {
            $table->dropColumn( 'school_name' );
        });
    }
}
