<?php

use FEMR\Data\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersTableAddApiKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function( Blueprint $table )
        {
            $table->string( 'api_token', 40 )->after( 'remember_token' );
        });

        // generate api keys for users without one
        $users = User::all();
        $users->each( function( $user )
        {
           if( empty( $user->api_key ) )
           {
               $user->api_key = str_random( 40 );
               $user->save();
           }
        });

        Schema::table('users', function( Blueprint $table )
        {
            $table->string( 'api_token' )->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function( Blueprint $table )
        {
            $table->dropColumn( 'api_key' );
        });
    }
}
