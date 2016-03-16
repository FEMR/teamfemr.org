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
            $message->to('femrsquad@gmail.com','Admin')->from('femrsquad@gmail.com')->subject('Approvals Needed.');
        });
        return redirect('/tripdatabase');
    }


}
