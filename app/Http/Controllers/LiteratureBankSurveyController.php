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
        $literatures = literature::where('approved', '=', 1)->get();
        return view('literaturebank', compact ('literatures'));
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

        //Getting uploaded file
        //$file = Request::file('file');
       // $file = $Request->file('photo');
        //if(Request::)
        //$file->move('/', abc);
       // dd($input);
        //Getting path of uploaded file
   // $path = Input::file('image')->getRealPath();
      //  $extension = Input::file('image')->getClientOriginalExtension();


        return redirect('emails/test2');


    }

}

