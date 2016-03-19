<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ApprovalsRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\literature;

class LitApprovalsController extends Controller
{
    public function edit()
    {
        $literatures = literature::where('approved', '=', 0)->get();

        return view('approvals/lit_approvals', compact('literatures'));
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
        foreach( $request->input( 'approved' ) as $literature_id )
        {
            // get the surveys row we want to update
            $literature = literature::findOrFail( $literature_id );

            // update the status
            $literature->approved = 1;

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
            $literature->save();

        }

        // Redirect to the edits page rather than display the form here
        // -- it is better to keep the routes separated
        //return view('approvals.edit', compact('Survey'));
        return redirect()->action( 'LitApprovalsController@edit' );
    }

}

