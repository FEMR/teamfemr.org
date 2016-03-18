<?php

namespace App\Http\Controllers;

use App\Survey;
use App\Place;
use Illuminate\Http\Request;
//use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TripSurveyController extends Controller
{
    //Call the Trip Database Survey view page
    public function index()
    {
        return view ('tripsurvey.index');
    }

    //Call the view page that controls the Trip Database Survey, while passing the unique id from the Trip Database Survey as a variable
    public function show($id)
    {
        $survey = Survey::find($id);

        return view('tripsurvey.show', compact('survey'));
    }

    //Call the view page
    public function create(){
        return view('tripsurvey.create');
    }

    //Redirect to the Trip Survey page
    public function store(Request $request)
    {

        $this->validate($request, [
            'teamname' => 'required',

        ]);

        $survey = Survey::create( $request->all() );
        foreach( $request->input( 'lat' ) as $id => $lat ){

            $lat = round( $lat, 5 );

            // we aren't 100% positive that $lng[$id] is set
            $lng = round( $request->input( 'lng' )[$id], 5);
            $address = $request->input( 'address' )[$id];
            $existing = Place::where( 'lat', '=', $lat )
                             ->where( 'lng', '=', $lng )
                             ->where( 'place', '=', $address)
                             ->first();

            if( $existing ){

                // link to the existing place
                $survey->places()->attach( $existing );
            }
            else{

                // Doesn't exist create new
                $survey->places()->create([

                    'lat' => $lat,
                    'lng' => $lng,
                    'place' => $address,
                    //'address' => $address
                ]);
            }

        }


        return redirect('emails');
    }
//

}
