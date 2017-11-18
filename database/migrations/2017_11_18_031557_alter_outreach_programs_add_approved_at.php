<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOutreachProgramsAddApprovedAt extends Migration
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
            $table->timestamp( 'approved_at' )->nullable()->after( 'comments' );
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
            $table->tdropColumn( 'approved_at' );
        });
    }
}
