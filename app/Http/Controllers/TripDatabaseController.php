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

        $places = Place::whereHas( 'surveys', function($query){

            $query->where( 'approved', '=', 1 );

        })
            ->with( 'surveys' )
            ->get();

        $surveys = Survey::where('approved', '=', 1)
                        ->with( 'places' )
                        ->get();



//        dd($surveys);
        return view( 'tripdatabase', compact('surveys') );
    }

}



