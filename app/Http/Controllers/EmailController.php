<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;
use App\User;
use App\Survey;

class EmailController extends Controller
{
    public function index( )
    {
        Mail::send('emails.test', ['name' => 'fEMR Admin'], function($message)
        {
            $message->to('femrsquad@gmail.com','Admin')->from('femrsquad@gmail.com')->subject('Please approve fEMR survey.');
        });
        return redirect('/tripdatabase');
    }

    public function approval( )
    {
        $Survey = Survey::all();
        return view('approvals', compact('Survey'));
    }

    public function store(Request $request)
    {
        $input = $request->only('id','status');

        $survey= Survey::findOrFail('id');

        $survey->status = ($request->input('is_approved')===1)? true:false;

        $survey->save();

    }
//editing the survey
//    public function update($survey_id, Request $request){
////        survey edit
//        $survey= Survey::findOrFail($survey_id);
//
//        $survey->is_approved= ($request->input('is_approved')===1)? true:false;
//
//        $survey->save();
//
//
//        $survey = Survey::where('is_approved', '=', 1)->get;
//
//        return view ('tripsurvey.create', compact('survey'));
//    }
}
