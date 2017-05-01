<?php

    //
    // Front End Routes
    //

    Auth::routes();

    Route::group( [ 'middleware' => 'web' ], function ()
    {

        Route::get( '/',      'PageController@home'      )->name( 'pages.home'  );
        Route::get( '/emr',   'PageController@emr'       )->name( 'pages.emr'   );
        Route::get( '/news',  'PageController@news'      )->name( 'pages.news'  );
        Route::get( '/slack', 'PageController@slack'     )->name( 'pages.slack' );
        
    });
