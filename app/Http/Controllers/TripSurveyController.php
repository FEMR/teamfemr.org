<?php

namespace App\Http\Controllers;

use App\Survey;
//use Illuminate\Http\Request;
use Request;
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
    public function store()
    {
        $input = Request::all();
        Survey::create($input);
       return redirect('tripsurvey');
    }

}
