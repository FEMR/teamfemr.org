<?php

namespace FEMR\Http\Controllers\API;

use FEMR\Http\Controllers\Controller;
use FEMR\Data\Models\OutreachProgram;

class OutreachProgramController extends Controller
{

    /**
     *
     * @return mixed
     */
    public function index()
    {
        // TODO -- use a Response here
        return OutreachProgram::withAll()->get();
    }

    /**
     * @param $outreach_program_id
     *
     * @return mixed
     */
    public function show( $outreach_program_id )
    {
        // TODO -- use a Response here
        return OutreachProgram::withAll()->findOrFail( $outreach_program_id );
    }
}
