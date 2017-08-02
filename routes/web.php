<?php

    //
    // Front End Routes
    //

    Auth::routes();

    Route::group( [ 'middleware' => 'web' ], function ()
    {
        Route::get( '/', 'PageController@home' )->name( 'pages.home'  );
        Route::get( '/programs/{program}', 'OutreachProgramController@show' )->name( 'programs.show'  );
    });
