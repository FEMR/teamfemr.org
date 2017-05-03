<?php

    //
    // Backend Routes
    //

    Route::group([ 'middleware' =>  [ 'auth' ], 'namespace' => 'Admin', 'prefix' => 'admin' ], function () {

        // Controllers Within The "App\Http\Controllers\Admin" Namespace

        Route::get( '/',       'DashboardController@index'   )->name( 'admin.dashboard.index'   );

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


        //
        // Outreach Programs
        //
        Route::get(    'schools/{school}/programs',                   'ProgramController@index'    )->name( 'admin.programs.index'    );
        Route::get(    'schools/{school}/programs/archived',          'ProgramController@archived' )->name( 'admin.programs.archived' );
        Route::get(    'schools/{school}/programs/create',            'ProgramController@create'   )->name( 'admin.programs.create'   );
        Route::post(   'schools/{school}/programs',                   'ProgramController@store'    )->name( 'admin.programs.store'    );
        Route::get(    'schools/{school}/programs/{program}/edit',    'ProgramController@edit'     )->name( 'admin.programs.edit'     );
        Route::put(    'schools/{school}/programs/{program}',         'ProgramController@update'   )->name( 'admin.programs.update'   );
        Route::delete( 'schools/{school}/programs/{program}',         'ProgramController@destroy'  )->name( 'admin.programs.destroy'  );
        Route::post(   'schools/{school}/programs/{program}/restore', 'ProgramController@restore'  )->name( 'admin.programs.restore'  );
    });
