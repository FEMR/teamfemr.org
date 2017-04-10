<?php

    //
    // Backend Routes
    //

    Route::group([ 'middleware' =>  [ 'auth' ], 'namespace' => 'Admin', 'prefix' => '/admin' ], function () {

        // Controllers Within The "App\Http\Controllers\Admin" Namespace
        Route::get( '/',        'DashboardController@index'   )->name( 'admin.dashboard.index'   );
        Route::get( '/sandbox', 'DashboardController@sandbox' )->name( 'admin.dashboard.sandbox' );
    });
