<?php

namespace FEMR\Http\Controllers;

use FEMR\Data\Models\OutreachProgram;

class OutreachProgramController extends Controller
{
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
                            'visitedLocations',
                            'fields',
                            'papers',
                            'partnerOrganizations'
                        ])
                        ->firstOrFail();

        return view( 'programs.show', [ 'program' => $program ] );
    }
}
