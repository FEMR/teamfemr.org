<?php

namespace App\Http\Controllers;

use App\Survey;
//use Illuminate\Http\Request;
use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TripSurveyController extends Controller
{
    public function index()
    {
        return view ('tripsurvey.index');
    }
    public function show($id)
    {
        $survey = Survey::find($id);

        return view('tripsurvey.show', compact('survey'));
    }

    public function create(){
        return view('tripsurvey.create');

    }

    public function store()
    {
        $input = Request::all();

        Survey::create($input);



       return redirect('tripsurvey');
    }

}
