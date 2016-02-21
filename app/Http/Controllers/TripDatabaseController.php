<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use App\Survey;
class TripDatabaseController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( )
    {
        $surveys = Survey::All();
        //dd($surveys);

        return view( 'tripdatabase', compact('surveys') );
    }

}
