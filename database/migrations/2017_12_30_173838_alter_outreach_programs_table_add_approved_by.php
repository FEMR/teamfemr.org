<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOutreachProgramsTableAddApprovedBy extends Migration
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
            $table->integer('approved_by')->unsigned()->nullable()->after( 'comments' );
            $table->foreign('approved_by')->references('id')->on('users');
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
            $table->dropColumn( 'approved_by' );
        });
    }
}
