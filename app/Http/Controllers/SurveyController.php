<?php

namespace FEMR\Http\Controllers;

use FEMR\Data\Models\OutreachProgram;

class SurveyController extends Controller
{

    /**
     * Show the survey
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $user = \Auth::user();

        return view( 'surveys.create', [ 'user' => $user ] );
    }

    /**
     * @param $program_id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit( $program_id )
    {
        $program = OutreachProgram::findOrFail( $program_id );
        $user = \Auth::user();

        return view( 'surveys.edit', [ 'program' => $program, 'user' => $user ] );
    }
}
