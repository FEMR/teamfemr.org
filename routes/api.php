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

    Route::get( '/programs/',             'OutreachProgramController@index' );
    Route::get( '/programs/{program_id}', 'OutreachProgramController@show'  );

    Route::get(  '/search',               'SearchController@create'      )->name( 'search.create'    );

    Route::post( '/survey',               'SurveyController@store'       )->name( 'survey.store'     );
    Route::get(  '/survey/form',          'Survey\FormController@show'   )->name( 'survey.form.show' );
    Route::get(  '/survey/{survey_id}',   'SurveyController@show'        )->name( 'survey.show'      );
    Route::put(  '/survey/{survey_id}',   'SurveyController@update'      )->name( 'survey.update'    )->middleware( 'auth:api' );

    Route::post( '/slack/invite',         'SlackInviteController@create' )->name( 'api.slack.invite' );

    Route::post( '/forum/media',          'Forum\MediaController@create' )->name( 'api.forum.media.store' );