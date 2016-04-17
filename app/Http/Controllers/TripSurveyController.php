<?php

namespace App\Http\Controllers;

use App\Survey;
use App\Place;
use Illuminate\Http\Request;
//use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Trip;

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

    //Editing the Survey ***********************************
    public function edit(Survey $survey){
        return view('tripsurvey.edit', compact('survey'));
    }

    public function update(Request $request, Survey $survey)
    {

        $survey->update($request->all());

        foreach( $request->input( 'lat' ) as $id => $lat ){

            $lat = round( $lat, 5 );

            // we aren't 100% positive that $lng[$id] is set
            $lng = round( $request->input( 'lng' )[$id], 5);
            $address = $request->input( 'address' )[$id];
            $existing = Place::where( 'lat', '=', $lat )
                ->where( 'lng', '=', $lng )
                ->where( 'place', '=', $address)
                ->first();


            $ngo = $request->input( 'partnerngo' )[$id];
            $months = $request->input( 'monthsoftravel')[$id];

            $trip = new Trip;
            $trip->partnerngo = $ngo;
            $trip->monthsoftravel = $months;
            $trip->survey_id = $survey->id;







            if( $existing ){

                // link to the existing place
                $trip->place_id = $existing->id;
                $trip->save();
            }
            else{

                // Doesn't exist create new
                $new_place = new Place;
                $new_place->lat = $lat;
                $new_place->lng = $lng;
                $new_place->place = $address;

                $new_place->save();
                $trip->place_id = $new_place->id;
                $trip->save();
            }

        }
        return back();
    }
//    *******************************************************

    //Redirect to the Trip Survey page
    public function store(Request $request)
    {

        $this->validate($request, [
            'teamname' => 'required',
            'initiated' => 'required',
            'totalmatriculants' => 'required',
            'medschoolterms' => 'required',
            'aidingschools' => 'required',
            'totalperyear' => 'required',
            'faculty' => 'required',
            'appprocess' => 'required',
            'programelements' => 'required',
            'finsupport' => 'required',
            'facultytimeallotted' => 'required',
            'adminsupport' => 'required',
            'contactinfo' => 'required'

        ]);

        $survey = Survey::create( $request->all() );

        $user = Auth::user();
        $survey->user_id = $user->id;
        $survey->save();
        if ($user->moderator())
        {
            $survey->approved = 1;
            $survey->save();
        }

        foreach( $request->input( 'lat' ) as $id => $lat ){

            $lat = round( $lat, 5 );

            // we aren't 100% positive that $lng[$id] is set
            $lng = round( $request->input( 'lng' )[$id], 5);
            $address = $request->input( 'address' )[$id];
            $existing = Place::where( 'lat', '=', $lat )
                             ->where( 'lng', '=', $lng )
                             ->where( 'place', '=', $address)
                             ->first();


            $ngo = $request->input( 'partnerngo' )[$id];
            $months = $request->input( 'monthsoftravel')[$id];

            $trip = new Trip;
            $trip->partnerngo = $ngo;
            $trip->monthsoftravel = $months;
            $trip->survey_id = $survey->id;







            if( $existing ){

                // link to the existing place
                $trip->place_id = $existing->id;
                $trip->save();
            }
            else{

                // Doesn't exist create new
                $new_place = new Place;
                $new_place->lat = $lat;
                $new_place->lng = $lng;
                $new_place->place = $address;

                $new_place->save();
                $trip->place_id = $new_place->id;
                $trip->save();
            }

        }
        if ($user->moderator())
        {
            return redirect('tripdatabase');
        }
        else
        {
            return redirect('emails');
        }

    }
//

}
