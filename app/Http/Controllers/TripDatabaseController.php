<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Place;
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



        $surveys = Survey::where('approved', '=', 1)
                        ->with( 'trips' )
                        ->get();

        return view( 'tripdatabase', compact('surveys') );
    }

    public function show( )
    {



        $surveys = Survey::where('approved', '=', 1)
            ->with( 'trips' )
            ->get();
        
        //Display all programs
        return view( 'allprograms', compact('surveys') );
//        return view('/allprograms');
    }

}



