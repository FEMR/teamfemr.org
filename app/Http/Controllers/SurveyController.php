<?php

namespace FEMR\Http\Controllers;

use FEMR\Http\Requests\SurveyRequest;
use Illuminate\Http\Request;

class SurveyController extends Controller
{

    /**
     * Show the survey
     *
     * @return [type] [description]
     */
    public function index()
    {
        return view( 'surveys.index' );
    }

    public function store( SurveyRequest $request )
    {
        return redirect()->route( 'surveys.index' );
    }
}
