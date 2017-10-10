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

        return \FEMR\Data\Models\VisitedLocation::with([

                    'outreachProgram.fields',
                    'outreachProgram.papers',
                    'outreachProgram.schoolClasses',
                    'outreachProgram.partnerOrganizations'
                ])
                ->get();

    });

    Route::get( '/programs/{program_id}', function ( $outreach_program_id, Request $request ) {
        
        return \FEMR\Data\Models\OutreachProgram::with([

                   'visitedLocations',
                   'fields',
                   'papers',
                   'schoolClasses',
                   'partnerOrganizations'
               ])
                ->find( $outreach_program_id );

    });

    Route::post( '/survey',             'SurveyController@store'     )->name( 'survey.store'     );
    Route::get(  '/survey/form',        'Survey\FormController@show' )->name( 'survey.form.show' );
    Route::get( '/survey/{survey_id}',  'SurveyController@show'      )->name( 'survey.show'      );

    Route::post( '/slack/invite', 'SlackController@invite'    )->name( 'api.slack.invite' );