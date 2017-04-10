<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutreachProgramMedicalSchoolClassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outreach_program_school_class', function (Blueprint $table)
        {
            $table->integer('outreach_program_id')->unsigned();
            $table->foreign('outreach_program_id')->references('id')->on('outreach_programs');
            $table->integer('school_class_id')->unsigned();

            // auto fk name is too long, so using a custom fk name
            $table->foreign('school_class_id', 'outreach_program_class_foreign')->references('id')->on('school_classes');
            $table->integer('class_size')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('outreach_program_school_class', function (Blueprint $table)
        {
            $table->dropForeign(['outreach_program_id']);

            // need to reference the custom fk name, not the laravel auto name
            $table->dropForeign('outreach_program_class_foreign');
        });
        Schema::drop('outreach_program_school_class');
    }
}
