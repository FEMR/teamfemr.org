<?php

namespace App\Http\Controllers;
use App\Literature;
use App\Survey;
//use Illuminate\Http\Request;
use Request;
use Storage;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class LiteratureBankSurveyController extends Controller
{
    public function index()
    {
       // $literatures = literature::where('approved', '=', 1)->get();

        $literatures = literature::all();
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
        $literature = Literature::create($input);


       //Survey is automatically approved if the user is a moderator
        $user = Auth::user();
        if ($user->moderator())
        {
            $literature->approved = 1;
            $literature->save();
        }

        // Image Upload
        if( Request::file('file') && Request::file('file')->isValid() )
        {
            $file_name = uniqid() . '.' . Request::file('file')->getClientOriginalExtension();
            $path = '/assets/uploads/' . $file_name;
            Request::file('file')->move(base_path() . '/public/assets/uploads/', $file_name);

            //dd($path);
            $literature->fileName = $path;
            $literature->save();
        }

        //If the user is a moderator, simply redirect the page to the literature bank (no need for a message that displays that the article has been submitted for verification)
        if ($user->moderator())
        {
            return redirect('literaturebank');
        }
        else
        {
            return redirect('emails/test2');
        }
    }
}

