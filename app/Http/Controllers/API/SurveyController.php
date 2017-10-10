<?php

namespace FEMR\Http\Controllers\API;

use FEMR\Data\Models\OutreachProgram;
use FEMR\Http\Controllers\Controller;
use FEMR\Http\Requests\SurveyRequest;
use Illuminate\Http\Request;

class SurveyController extends Controller
{

    public function show( $program_id ) {

        $program = OutreachProgram::with([
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
                            ->find( $program_id );

        return $program;
    }

    /**
     * @param SurveyRequest $request
     *
     * @return OutreachProgram
     */
    public function store( SurveyRequest $request )
    {
        /** @var OutreachProgram $program */
        $program = OutreachProgram::create( $request->survey() );

        $program->syncSchoolClasses( $request->input( 'school_classes' ) );
        $program->syncAdditionalFields( $request->input( 'additional_fields' ) );

        // TODO -- make this work
        foreach( $request->input( 'locations' ) as $newLocation )
        {
            $program->visitedLocations()->create( $newLocation );
        }

        // TODO -- handle empty fields
        foreach( $request->input( 'papers' ) as $newPaper )
        {
            $program->papers()->create( $newPaper );
        }

        foreach( $request->input( 'contacts' ) as $newContact )
        {
            $program->contacts()->create( $newContact );
        }

        foreach( $request->input( 'partners' ) as $newPartner )
        {
            $program->partnerOrganizations()->create( $newPartner );
        }

        // TODO - add a proper resource response here
        return $program;
    }
}
