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
        return view ('litbanksurvey.index');
    }
    public function show($id)
    {
        $literature = Literature::find($id);

        return view('litbanksurvey.show', compact('literature'));
    }

    public function create(){
        return view('litbanksurvey.create');

    }

    public function store()
    {
        $input = Request::all();

        Literature::create($input);



        return redirect('litbanksurvey');
    }

}

