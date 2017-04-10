<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutreachProgramPartnerOrganizationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outreach_program_partner', function (Blueprint $table)
        {
            $table->integer('outreach_program_id')->unsigned();
            $table->foreign('outreach_program_id')->references('id')->on('outreach_programs');
            $table->integer('partner_id')->unsigned();
            $table->foreign('partner_id')->references('id')->on('partner_organizations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('outreach_program_partner', function (Blueprint $table)
        {
            $table->dropForeign(['outreach_program_id']);
            $table->dropForeign(['partner_id']);
        });
        Schema::drop('outreach_program_partner');
    }
}
