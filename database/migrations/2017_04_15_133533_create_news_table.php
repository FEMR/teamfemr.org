<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string( 'title' );
            $table->string( 'slug' )->unique();
            $table->text( 'url' )->nullable();
            $table->text( 'content' )->nullable();
            $table->text( 'excerpt' )->nullable();
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
        Schema::drop( 'news' );
    }
}
