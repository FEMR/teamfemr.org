<?php

namespace App\Http\Controllers;
use App\Literature;
use App\Survey;
//use Illuminate\Http\Request;
use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class LiteratureBankSurveyController extends Controller
{
    public function index()
    {
        //Call view page for Literature Bank Survey
        return view ('litbanksurvey.index');
    }
    public function show($id)
    {
        //Call view page while passing variable literature (unique id from Literature Bank Survey)
        $literature = Literature::find($id);
        return view('litbanksurvey.show', compact('literature'));
    }

    public function create()
    {
        //Call view page that is part of creating the Literature Bank Survey
        return view('litbanksurvey.create');
    }

    public function store()
    {
        //Call view page for Literature Bank survey, while passing data
        $input = Request::all();
        Literature::create($input);
        return redirect('litbanksurvey');
    }

}

