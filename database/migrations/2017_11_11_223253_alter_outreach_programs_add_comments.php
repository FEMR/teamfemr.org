<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOutreachProgramsAddComments extends Migration
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
            $table->text( 'comments' )->default('')->after( 'uses_emr' );
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
            $table->dropColumn( 'comments' );
        });
    }
}
