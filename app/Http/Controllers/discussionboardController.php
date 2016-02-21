<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Survey;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class discussionboardController extends Controller
{
    public function index( )
    {
        $surveys = Survey::All();
        //dd($surveys);

        return view( 'discussionboard', compact('surveys') );
    }//
}
