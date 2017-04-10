<?php

    Auth::routes();

    Route::group( [ 'middleware' => 'web' ], function ()
    {

        //
        // Front End Routes
        //

        Route::get( '/',      'PageController@home'      )->name( 'pages.home'  );
        Route::get( '/emr',   'PageController@emr'       )->name( 'pages.emr'   );
        Route::get( '/news',  'PageController@news'      )->name( 'pages.news'  );
        Route::get( '/slack', 'PageController@slack'     )->name( 'pages.slack' );


        //
        // Json Request Routes
        //

        Route::group([ 'namespace' => 'Json' ], function()
        {
            Route::get( '/cities/random.json', 'CityController@random' )->name( 'cities.random' );
        });


        //
        // Backend Routes
        //

        Route::group([ 'namespace' => 'Admin', 'prefix' => '/admin' ], function () {

            // Controllers Within The "App\Http\Controllers\Admin" Namespace
            Route::get( '/', 'DashboardController@index' )->name( 'admin.dashboard.index' );
        });
        
    });


Route::get('/home', 'HomeController@index');
