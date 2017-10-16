<?php

namespace FEMR\Http\Controllers\API;

use FEMR\Data\Models\OutreachProgram;
use FEMR\Http\Controllers\Controller;
use FEMR\Http\Requests\SurveyRequest;
use FEMR\Http\Resources\OutreachProgramResource;

class SurveyController extends Controller
{
    /**
     * @param $program_id
     *
     * @return OutreachProgramResource
     */
    public function show( $program_id ) {

        $program = OutreachProgram::withAll()->findOrFail( $program_id );

        return new OutreachProgramResource( $program );
    }

    /**
     * @param SurveyRequest $request
     *
     * @return OutreachProgramResource
     */
    public function store( SurveyRequest $request )
    {
        /** @var OutreachProgram $program */
        $program = OutreachProgram::create( $request->survey() );

        $program->syncSchoolClasses( $request->input( 'school_classes' ) )
                ->syncAdditionalFields( $request->input( 'additional_fields' ) )
                ->syncVisitedLocations( $request->input( 'locations' ) )
                ->syncContacts( $request->input( 'contacts' ) )
                ->syncPapers( $request->input( 'papers' ) )
                ->syncPartnerOrganizations( $request->input( 'partners' ) );


        return new OutreachProgramResource( $program );
    }

    /**
     * @param $survey_id
     * @param SurveyRequest $request
     *
     * @return OutreachProgramResource
     */
    public function update( $survey_id, SurveyRequest $request )
    {
        // TODO -- handle removing of existing entities

        /** @var OutreachProgram $program */
        $program = OutreachProgram::findOrFail( $survey_id );

        $program->update( $request->survey() );

        $program->syncSchoolClasses( $request->input( 'school_classes' ) )
                ->syncAdditionalFields( $request->input( 'additional_fields' ) )
                ->syncVisitedLocations( $request->input( 'visited_locations' ) )
                ->syncContacts( $request->input( 'contacts' ) )
                ->syncPapers( $request->input( 'papers' ) )
                ->syncPartnerOrganizations( $request->input( 'partners' ) );


        return new OutreachProgramResource( $program );
    }
}
