<?php

    //
    // Backend Routes
    //

    Route::group([ 'middleware' =>  [ 'auth', 'can:view-admin' ] ], function () {

        // Controllers Within The "App\Http\Controllers\Admin" Namespace

        Route::get( '/',       'DashboardController@index'   )->name( 'admin.dashboard.index'   );

        //
        // Outreach Programs
        //
        Route::get(    'programs',                   'ProgramController@index'    )->name( 'admin.programs.index'    );
        Route::get(    'programs/archived',          'ProgramController@archived' )->name( 'admin.programs.archived' );
        Route::get(    'programs/create',            'ProgramController@create'   )->name( 'admin.programs.create'   );
        Route::post(    'programs',                  'ProgramController@store'    )->name( 'admin.programs.store'    );
        Route::get(    'programs/{program}/edit',    'ProgramController@edit'     )->name( 'admin.programs.edit'     );
        Route::put(    'programs/{program}',         'ProgramController@update'   )->name( 'admin.programs.update'   );
        Route::delete( 'programs/{program}',         'ProgramController@destroy'  )->name( 'admin.programs.destroy'  );
        Route::post(   'programs/{program}/restore', 'ProgramController@restore'  )->name( 'admin.programs.restore'  );

        Route::post(   'programs/{program}/approve', 'Program\ApproveController@store'   )->name( 'admin.programs.approve.store'   );
        Route::delete( 'programs/{program}/approve', 'Program\ApproveController@destroy' )->name( 'admin.programs.approve.destroy' );
    });
