<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('news', function (Blueprint $table)
        {
            // remove old columns
            $table->dropColumn('slug');
            $table->dropColumn( 'content' );
            $table->dropColumn( 'excerpt' );

            // add new columns
            $table->string('thumbnail')->after('url');
            $table->string('thumbnail_alt')->after('thumbnail');
            $table->boolean('is_featured')->default(false)->after('thumbnail_alt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news', function (Blueprint $table)
        {
            // remove old columns
            $table->dropColumn( 'thumbnail' );
            $table->dropColumn( 'is_featured' );

            // add new columns
            $table->string( 'slug' )->unique();
            $table->text( 'content' )->nullable()->after('url');
            $table->text( 'excerpt' )->nullable()->after('content');
        });
    }
}
