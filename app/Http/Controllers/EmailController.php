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
//    sends email to client
    public function index( )
    {
        Mail::send('emails.test', ['name' => 'fEMR Admin'], function($message)
        {
            $message->to('femrsquad@gmail.com','Admin')->from('femrsquad@gmail.com')->subject('Please approve fEMR survey.');
        });
        return redirect('/tripdatabase');
    }


//editing the survey
//
//    public function update($survey_id, Request $request){
//
//        $survey= Survey::findOrFail($survey_id);
//
//        $survey->is_approved= ($request->input('status')===1)? true:false;
//
//        $survey->save();
//
//
//        $survey = Survey::where('status', '=', 1)->get;
//
//        return view ('tripsurvey.create', compact('survey'));
//    }
}
