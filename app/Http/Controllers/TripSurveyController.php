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
                    //'address' => $address
                ]);
            }

        }




        //$input = Request::all();
//        $input = $request->except('lat', 'lng');
//
//        $survey = new Survey($input);
//        $survey->approved = false;
//        $input2 = $request->only('lat', 'lng');
//
//       // $place = Place::where('lat', '=', $input2['lat'])->where('lng', '=', $input2['lng'])->findOrFail(1);
//        //$place = Place::where('lat', '=', '5')->firstOrFail();
//        $place = Place::firstOrNew(['lat' => $input2['lat'], 'lng' => $input2['lng']]);
//
//
//        $survey->save();
//
//
//        //$place->survey_id = $survey->id;
//       // dd($place);
//        $survey->places()->save($place);
       // $place->surveys()->save($survey);

//        Session::flash('flash_message', 'Survey successfully submitted!');{{--This did not work RD --}}


        return redirect('emails');
    }
//

}
