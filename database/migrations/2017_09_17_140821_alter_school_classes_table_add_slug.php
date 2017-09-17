<?php

use FEMR\Data\Models\SchoolClass;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Str;

class AlterSchoolClassesTableAddSlug extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('school_classes', function( Blueprint $table )
        {
            $table->string( 'slug' )->after('name');
        });

        // populate slugs of existing school classes
        SchoolClass::all()->each( function( $class )
        {
            $class->slug = Str::slug( $class->name );
            $class->save();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('school_classes', function( Blueprint $table )
        {
            $table->dropColumn( 'slug' );
        });
    }
}
