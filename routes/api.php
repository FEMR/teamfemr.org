<?php

//    use Illuminate\Http\Request;

    /*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
    */
//    Route::get('/user', function (Request $request) {
//        return $request->user();
//    })->middleware('auth:api');


    // TODO - improve this later
    Route::get( '/locations', function ( Request $request) {

        return \FEMR\Data\Models\VisitedLocation::all();

    });



    Route::post( 'slack/invite', 'SlackController@invite' )->name( 'api.slack.invite' );