<?php

namespace FEMR\Http\Controllers;

use FEMR\Http\Requests\SurveyRequest;
use Illuminate\Http\Request;

class SurveyController extends Controller
{

    public function index()
    {
        return view( 'surveys.index' );
    }

    public function store( SurveyRequest $request )
    {
        dd( $request );

        return redirect()->route( 'surveys.index' );
    }
}
