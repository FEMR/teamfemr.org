<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutreachProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outreach_programs', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('year_initiated')->nullable();
            $table->integer('yearly_outreach_participants')->nullable();
            $table->integer('matriculants_per_class')->nullable();
            $table->string('months_of_travel')->nullable();
            $table->boolean('uses_emr')->default(false);
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
        Schema::table('outreach_programs', function (Blueprint $table)
        {
            $table->dropForeign(['school_id']);
        });
        Schema::drop('outreach_programs');
    }
}
