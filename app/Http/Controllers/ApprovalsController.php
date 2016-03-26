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
        $surveys = Survey::where('approved', '=', 0)->get();

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
    if($request->input('approvals'))
    {
        // loop through the submitted approvals -> which are survey_ids that need to be marked as approved
        foreach( $request->input( 'approvals' ) as $survey_id )
        {
            // get the surveys row we want to update
            $survey = Survey::findOrFail( $survey_id );

            // update the status
            $survey->approved = 1;

            // Update (save) record back in the database
            $survey->save();

        }
    }
        foreach( $request->input( 'deletes' ) as $survey_id )
        {
            // get the surveys row we want to update
            $survey = Survey::findOrFail( $survey_id );

            // update the status
            $survey->delete();

        }

        // Redirect to the edits page rather than display the form here
        // -- it is better to keep the routes separated
        //return view('approvals.edit', compact('Survey'));
        return redirect()->action( 'ApprovalsController@edit' );
    }


}