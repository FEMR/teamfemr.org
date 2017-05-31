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
        Route::get( 'programs', 'ProgramController@all' )->name( 'admin.programs.all' );
        Route::group([ 'prefix' => 'schools/{school}' ], function(){


            Route::get(    'programs',                   'ProgramController@index'    )->name( 'admin.programs.index'    );
            Route::get(    'programs/archived',          'ProgramController@archived' )->name( 'admin.programs.archived' );
            Route::get(    'programs/create',            'ProgramController@create'   )->name( 'admin.programs.create'   );
            Route::post(   'programs',                   'ProgramController@store'    )->name( 'admin.programs.store'    );
            Route::get(    'programs/{program}/edit',    'ProgramController@edit'     )->name( 'admin.programs.edit'     );
            Route::put(    'programs/{program}',         'ProgramController@update'   )->name( 'admin.programs.update'   );
            Route::delete( 'programs/{program}',         'ProgramController@destroy' )->name( 'admin.programs.destroy'  );
            Route::post(   'programs/{program}/restore', 'ProgramController@restore'  )->name( 'admin.programs.restore'  );
        });

        //
        // Papers
        //
        Route::group([ 'prefix' => 'programs/{program}', 'namespace' => 'Json' ], function() {

            Route::get(    'papers',                 'PaperController@index'    )->name( 'admin.papers.index'    );
            Route::get(    'papers/archived',        'PaperController@archived' )->name( 'admin.papers.archived' );
            Route::post(   'papers',                 'PaperController@store'    )->name( 'admin.papers.store'    );
            Route::put(    'papers/{paper}',         'PaperController@update'   )->name( 'admin.papers.update'   );
            Route::delete( 'papers/{paper}',         'PaperController@destroy'  )->name( 'admin.papers.destroy'  );
            Route::post(   'papers/{paper}/restore', 'PaperController@restore'  )->name( 'admin.papers.restore'  );
        });

        //
        // Partner Organizations
        //
        Route::group([ 'prefix' => 'programs/{program}', 'namespace' => 'Json' ], function() {

            Route::get(    'partners',                   'PartnerController@index'    )->name( 'admin.partners.index'    );
            Route::get(    'partners/archived',          'PartnerController@archived' )->name( 'admin.partners.archived' );
            Route::post(   'partners',                   'PartnerController@store'    )->name( 'admin.papers.store'      );
            Route::put(    'partners/{partner}',         'PartnerController@update'   )->name( 'admin.partners.update'   );
            Route::delete( 'partners/{partner}',         'PartnerController@destroy'  )->name( 'admin.partners.destroy'  );
            Route::post(   'partners/{partner}/restore', 'PartnerController@restore'  )->name( 'admin.partners.restore'  );
        });
    });
