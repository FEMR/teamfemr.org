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

    //Call view page for Trip Database, while passing the Trip Database survey variable
    public function index( )
    {
        $surveys = Survey::where('approved', '=', 1)->get();
//        dd($surveys);
        return view( 'tripdatabase', compact('surveys') );
    }

}



