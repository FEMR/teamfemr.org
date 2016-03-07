<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApprovalsRequest;

use App\Http\Requests;
use App\Survey;
use DB;

class ApprovalsController extends Controller
{

    public function edit()
    {
        $surveys = Survey::where('status', '=', 0)->get();

        return view('approvals/edit', compact('surveys'));
    }

    /**
     *
     *
     * @param ApprovalsRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update( ApprovalsRequest $request )
    {
        /*
            The ApprovalsRequest class will validate the request from the form. You can define the fields in the form
                and the expected data types and Laravel will automatically validate the data. Then by this point you
                know the form data is valid and you can update the database table.

            The request looks like:

                  array:3 [▼
                      "_method" => "PATCH"
                      "_token" => "ho6jGpxemYI1vP2hnsjiZPbtaD6mLAH7UGaDRbiY"
                      "approvals" => array:2 [▼
                        0 => "1"
                        1 => "2"
                      ]
                    ]
         */

        // loop through the submitted approvals -> which are survey_ids that need to be marked as approved
        foreach( $request->input( 'approvals' ) as $survey_id )
        {
            // get the surveys row we want to update
            $survey = Survey::findOrFail( $survey_id );

            // update the status
            $survey->status = 1;

            /**
             *  NOTE: I a little unclear on the name `status` for the column used above. Its not very clear at a first
             *      glance what that field represents. Would it make more sense to name that column `is_approved` rather
             *      than status?
             *
             *  If you do want to keep the name of the column `status`, that can work, but really that column should be a
             *      foreign key to a `statuses` table in the database. The `statuses` table would be just an `id` and a
             *      `name` column. Then it would be a little clearer what `status` represents is to a newcomer to the code.
             *
             *  There are pros and cons to both methods. Ultimately its up to you, just giving a suggestion
             */

            // Update (save) record back in the database
            $survey->save();

        }

        // Redirect to the edits page rather than display the form here
        // -- it is better to keep the routes separated
        //return view('approvals.edit', compact('Survey'));
        return redirect()->action( 'ApprovalsController@edit' );
    }

}

//*********************************************************************************************
//Text below is previous code, might use in future
        //$Survey = Survey::findOrFail($id);

//        $this->validate($request, [
//            'title' => 'required',
//            'description' => 'required'
//        ]);
//        $input = $request->only('approved');
//        dd($input);
////        $input = $request->all();
//
//        $Survey->fill($input)->save();
//
////        Session::flash('flash_message', 'Survey successfully approved!');
//
////        return redirect()->back();
//        return redirect('tripdatabase', compact('Survey'));




//
//    public function approval( )
//    {
//        $Survey = Survey::all();
//       //$Survey = Survey::where('status', '=', 0)->get;
//        return view('approvals.edit', compact('Survey'));
//    }

//    public function store(Request $request)
//    {
//        $input = $request->only('approved');
////
////        $survey= Survey::findOrFail('id');
////
////        $survey->status = ($request->input('status')===1)? true:false;
////
////        $survey->save();
//
////        $this->validate($request, [
////            'title' => 'required',
////            'description' => 'required'
////        ]);
//        dd($input);
////        $input = $request->all();
//
//        Survey::create($input);
//
////        Session::flash('flash_message', 'Task successfully added!');
//
////        return redirect()->back();
//        return redirect('tripdatabase', compact('Survey'));
//
//    }
