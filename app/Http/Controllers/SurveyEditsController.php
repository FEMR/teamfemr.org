<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Place;
use App\User;
use Illuminate\Http\Request;
use App\Survey;

class SurveyEditsController extends Controller
{
    //
    public function index()
    {
        $surveys = Survey::All();
        return view ('approvals/surveyedits', compact('surveys'));
    }
}
