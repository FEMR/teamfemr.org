<?php

namespace FEMR\Http\Controllers\API;

use FEMR\Http\Controllers\Controller;
use FEMR\Data\Models\OutreachProgram;
use FEMR\Http\Requests\API\OutreachProgramRequest;
use FEMR\Http\Resources\OutreachProgramResource;

class OutreachProgramController extends Controller
{

    /**
     *
     * @param OutreachProgramRequest $request
     *
     * @return mixed
     */
    public function index( OutreachProgramRequest $request )
    {
        $programs = OutreachProgram::withAll()->filter( $request->filters() )->get();

        return OutreachProgramResource::collection( $programs );
    }

    /**
     * @param $outreach_program_id
     *
     * @return mixed
     */
    public function show( $outreach_program_id )
    {
        $program = OutreachProgram::withAll()->findOrFail( $outreach_program_id );

        return new OutreachProgramResource( $program );
    }
}
