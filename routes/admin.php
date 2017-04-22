<?php

    //
    // Backend Routes
    //

    Route::group([ 'middleware' =>  [ 'auth' ], 'namespace' => 'Admin', 'prefix' => 'admin' ], function () {

        // Controllers Within The "App\Http\Controllers\Admin" Namespace

        Route::get( '/',       'DashboardController@index'   )->name( 'admin.dashboard.index'   );
        Route::get( 'sandbox', 'DashboardController@sandbox' )->name( 'admin.dashboard.sandbox' );

        //
        // Schools
        //
        Route::get(    'schools',                  'SchoolController@index'    )->name( 'admin.schools.index'    );
        Route::get(    'schools/archived',         'SchoolController@archived' )->name( 'admin.schools.archived' );
        Route::get(    'schools/create',           'SchoolController@create'   )->name( 'admin.schools.create'   );
        Route::post(   'schools',                  'SchoolController@store'    )->name( 'admin.schools.store'    );
        Route::get(    'schools/{school}/edit',    'SchoolController@edit'     )->name( 'admin.schools.edit'     );
        Route::put(    'schools/{school}',         'SchoolController@update'   )->name( 'admin.schools.update'   );
        Route::delete( 'schools/{school}',         'SchoolController@destroy'  )->name( 'admin.schools.destroy'  );
        Route::post(   'schools/{school}/restore', 'SchoolController@restore'  )->name( 'admin.schools.restore'  );

    });
