<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medias', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('mediaable_id')->index();
            $table->string('mediaable_type');
            $table->string('key');
            $table->string('name');
            $table->string('meta_title');
            $table->string('meta_alt');
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
        Schema::drop( 'medias' );
    }
}
