<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Survey;

class ApprovalsController extends Controller
{
    //
    public function approval( )
    {
        $Survey = Survey::all();
       //$Survey = Survey::where('status', '=', 0)->get;
        return view('approvals.edit', compact('Survey'));
    }

    public function store(Request $request)
    {
        $input = $request->only('approved');
//
//        $survey= Survey::findOrFail('id');
//
//        $survey->status = ($request->input('status')===1)? true:false;
//
//        $survey->save();

//        $this->validate($request, [
//            'title' => 'required',
//            'description' => 'required'
//        ]);
        dd($input);
//        $input = $request->all();

        Survey::create($input);

//        Session::flash('flash_message', 'Task successfully added!');

//        return redirect()->back();
        return redirect('tripdatabase', compact('Survey'));

    }

    public function edit()
    {
        $Survey = Survey::where('status', 0)->get();

        return view('approvals.edit', compact('Survey'));
    }

    public function update( Request $request)
    {
        //$Survey = Survey::findOrFail($id);

//        $this->validate($request, [
//            'title' => 'required',
//            'description' => 'required'
//        ]);
        $input = $request->only('approved');
        dd($input);
//        $input = $request->all();

        $Survey->fill($input)->save();

//        Session::flash('flash_message', 'Survey successfully approved!');

//        return redirect()->back();
        return redirect('tripdabase', compact('Survey'));
    }
}
