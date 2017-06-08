<?php

namespace FEMR\Http\Controllers\Admin\Json;

use FEMR\Data\Models\Contact;
use FEMR\Data\Models\OutreachProgram;
use FEMR\Http\Controllers\Controller;
use FEMR\Http\Requests\Admin\Json\ContactRequest;

class ContactController extends Controller
{

    /**
     * @param $program_id
     *
     * @return mixed
     */
    public function index( $program_id )
    {
        return Contact::whereHas( 'outreachProgram', function ( $query ) use ( $program_id )
                        {
                            $query->where( 'id', '=', $program_id );
                        } )
                      ->get();
    }

    /**
     * @param $program_id
     * @param ContactRequest $request
     *
     * @return mixed
     */
    public function store( $program_id, ContactRequest $request )
    {
        $program = OutreachProgram::findOrFail( $program_id );

        return $program->contacts()->create( $request->all() );
    }

    /**
     * @param $program_id
     * @param $contact_id
     * @param ContactRequest $request
     *
     * @return mixed
     */
    public function update( $program_id, $contact_id, ContactRequest $request )
    {
        $contact = Contact::whereHas('outreachProgram', function ( $query ) use ( $program_id )
                            {
                                $query->where( 'id', '=', $program_id );
                            } )
                          ->findOrFail( $contact_id );
        return [

            'status' => $contact->update( $request->all() )
        ];
    }

    /**
     * @param $program_id
     * @param $contact_id
     *
     * @return mixed
     */
    public function destroy( $program_id, $contact_id )
    {
        return [

            'status' => Contact::whereHas('outreachProgram', function ( $query ) use ( $program_id )
                                {
                                    $query->where( 'id', '=', $program_id );
                                } )
                               ->findOrFail( $contact_id )
                               ->delete()
        ];
    }

    /**
     * @param $program_id
     * @param $contact_id
     *
     * @return mixed
     */
    public function restore( $program_id, $contact_id )
    {
        $contact = Contact::whereHas('outreachProgram', function ( $query ) use ( $program_id )
                            {
                                $query->where( 'id', '=', $program_id );
                            } )
                          ->withTrashed()
                          ->findOrFail( $contact_id );

        return $contact->restore();
    }
}