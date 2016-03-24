<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;
use App\User;
use App\Survey;


class ConfirmationMsgController extends Controller
{
    //
    public function index( )
    {
        return view('confirmations.surveymsg');
    }

    public function literature( )
    {
        return view('confirmations.literaturemsg');
    }
}
