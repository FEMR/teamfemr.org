<?php

namespace FEMR\Http\Controllers\API;

use FEMR\Data\Models\OutreachProgram;
use FEMR\Data\Models\User;
use FEMR\Http\Controllers\Controller;
use FEMR\Http\Requests\API\SurveyRequest;
use FEMR\Http\Resources\OutreachProgramResource;
use Illuminate\Auth\AuthenticationException;

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

        // If being created by a non-admin user, attach user to survey
        if( \Auth::guard('api')->check() ) {

            /** @var User $user */
            $user = \Auth::guard('api')->user();
            if( ! $user->is_admin ) {

                $program->users()->attach( $user );
            }
        }

        return new OutreachProgramResource( $program );
    }

    /**
     * @param $survey_id
     * @param SurveyRequest $request
     *
     * @return OutreachProgramResource
     * @throws AuthenticationException
     */
    public function update( $survey_id, SurveyRequest $request )
    {
        /** @var OutreachProgram $program */
        $program = OutreachProgram::findOrFail( $survey_id );

        /** @var User $user */
        $user = \Auth::guard('api')->user();
        if( ! $user->can( 'update-survey', $program ) )
        {
            throw new AuthenticationException( );
        }

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
