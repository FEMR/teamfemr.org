<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutreachProgramFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outreach_program_fields', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('outreach_program_id')->unsigned();
            $table->foreign('outreach_program_id')->references('id')->on('outreach_programs');
            $table->string('name');
            $table->string('key');
            $table->text('value');
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
        Schema::table('outreach_program_fields', function (Blueprint $table)
        {
            $table->dropForeign(['outreach_program_id']);
        });
        Schema::drop('outreach_program_fields');
    }
}
