<?php

    //
    // Front End Routes
    //

    Auth::routes();

    Route::group( [ 'middleware' => 'web' ], function ()
    {
        Route::get( '/', 'PageController@home' )->name( 'pages.home'  );

        // Outreach Programs
        Route::get( '/programs',           'OutreachProgramController@index' )->name( 'programs.index' );
        Route::get( '/programs/{program}', 'OutreachProgramController@show'  )->name( 'programs.show'  );

        // Surveys
        Route::get(  '/surveys', 'SurveyController@index' )->name( 'surveys.index' );
        Route::post( '/surveys', 'SurveyController@store' )->name( 'surveys.store' );
    });
