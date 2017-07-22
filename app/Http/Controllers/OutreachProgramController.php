<?php

namespace FEMR\Http\Controllers;

use Illuminate\Http\Request;

class OutreachProgramController extends Controller
{

    public function show( $program_slug )
    {
        return $program_slug;
    }
}
