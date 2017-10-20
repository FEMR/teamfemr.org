<?php

namespace FEMR\Http\Controllers\API;

use FEMR\Http\Controllers\Controller;
use FEMR\Data\Models\OutreachProgram;

class OutreachProgramController extends Controller
{

    /**
     * @param $outreach_program_id
     *
     * @return mixed
     */
    public function show( $outreach_program_id )
    {
        return OutreachProgram::withAll()->findOrFail( $outreach_program_id );
    }
}
