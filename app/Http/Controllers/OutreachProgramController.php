<?php

namespace FEMR\Http\Controllers;

use FEMR\Data\Models\OutreachProgram;

class OutreachProgramController extends Controller
{
    /**
     * 
     */
    public function index()
    {
        $programs = OutreachProgram::orderBy( 'name' )
                        ->with([
                                  'medias',
                                  'contacts',
                                  'schoolClasses',
                                  'visitedLocations' => function( $query )
                                  {
                                      $query->orderBy( 'country' );
                                  },
                                  'fields',
                                  'papers',
                                  'partnerOrganizations'
                              ])
                       ->get();
        
        return view( 'programs.index', [ 'programs' => $programs ]);
    }

    /**
     * @param $program_slug
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show( $program_slug )
    {
        $program = OutreachProgram::
                        slug( $program_slug )
                        ->with([
                            'medias',
                            'contacts',
                            'schoolClasses',
                            'visitedLocations' => function( $query )
                                {
                                    $query->orderBy( 'country' );
                                },
                            'fields',
                            'papers',
                            'partnerOrganizations'
                        ])
                        ->firstOrFail();

        return view( 'programs.show', [ 'program' => $program ] );
    }
}
