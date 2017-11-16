<?php

namespace FEMR\Http\Controllers\API\Survey;

use FEMR\Data\Models\OutreachProgram;
use FEMR\Data\Models\PartnerOrganization;
use FEMR\Data\Models\SchoolClass;
use FEMR\Http\Controllers\Controller;

class FormController extends Controller
{

    public function show()
    {
        $fields = [

            "name" => [

                "name"       => 'name',
                "label"      => 'Title of Program',
                "validators" => 'required'
            ],
            "schoolName" => [

                "name"       => 'schoolName',
                "label"      => 'Name of School',
                "validators" => ''
            ],
            "usesEmr" => [

                "name"        => 'usesEmr',
                "label"       => 'Do you use an emr?',
                "placeholder" => 'Please select',
                "validators"  => 'required',
                "options"     => [

                    "yes" => 'Yes',
                    "no"  => 'No'
                ]
            ],
            "yearInitiated" => [

                "name"       => 'yearInitiated',
                "label"      => 'Year Initiated',
                "type"       => 'tel',
                "validators" => 'max_value:' . date('Y')
            ],
            "yearlyOutreachParticipants" => [

                "name"       => 'yearlyOutreachParticipants',
                "label"      => 'Total participants in global health outreach per year',
                "type"       => 'tel',
                "validators" => 'min_value:0'
            ],
            "monthsOfTravel" => [

                "name"       => 'monthsOfTravel',
                "label"      => 'Month(s) of Travel (Select all that apply)',
                "isFullWidth" => true,
                "options" => [

                    [ 'label' => 'January',   'value' => 'January'   ],
                    [ 'label' => 'February',  'value' => 'February'  ],
                    [ 'label' => 'March',     'value' => 'March'     ],
                    [ 'label' => 'April',     'value' => 'April'     ],
                    [ 'label' => 'May',       'value' => 'May'       ],
                    [ 'label' => 'June',      'value' => 'June'      ],
                    [ 'label' => 'July',      'value' => 'July'      ],
                    [ 'label' => 'August',    'value' => 'August'    ],
                    [ 'label' => 'September', 'value' => 'September' ],
                    [ 'label' => 'October',   'value' => 'October'   ],
                    [ 'label' => 'November',  'value' => 'November'  ],
                    [ 'label' => 'December',  'value' => 'December'  ]
                ]
            ],
            "matriculantsPerClass" => [

                "name"       => 'matriculantsPerClass',
                "label"      => 'Total number of matriculants per class',
                "type"       => 'tel',
                "validators" => 'min_value:0'
            ],
            "schoolClasses" => [

                "name"        => 'schoolClasses',
                "label"       => 'Medical school student class involvement (Select all that apply)',
                "validators"  => '',
                'isFullWidth' => true,
                "options"     =>  SchoolClass::select( 'name', 'slug' )
                                            ->orderBy( 'name' )
                                            ->get()
                                            ->map( function( $class )
                                            {
                                                return [ 'label' => $class->name, 'value' => $class->slug ];
                                            })
            ],
            "comments" => [

                "name"       => 'comments',
                "label"      => 'Notes/Comments',
                "type"       => 'text',
                "validators" => ''
            ],
            "additionalFields" => [],
            "contacts" => [

                [
                    "name"       => 'fullName',
                    "label"      => 'Name',
                    "value"      => '',
                    "hideLabel"  => true,
                    "validators" => 'required',
                    "icon"       => 'fa-user'
                ],
                [
                    "value"      => '',
                    "name"       => 'email',
                    "type"       => 'email',
                    "label"      => 'Email (Optional)',
                    "hideLabel"  => true,
                    "validators" => 'email',
                    "icon"       => 'fa-envelope-o'
                ],
                [
                    "value"      => '',
                    "name"       => 'phone',
                    "type"       => 'tel',
                    "label"      => 'Phone (Optional)',
                    "hideLabel"  => true,
                    "validators" => '',
                    "icon"       => 'fa-phone'
                ]
            ],
            "papers" => [
                [
                    "value"      => '',
                    "name"       => 'title',
                    "label"      => 'Title',
                    "hideLabel"  => true,
                    "validators" => '',
                    "icon"       => 'fa-file-text-o'
                ],
                [
                    "value"      => '',
                    "name"       => 'url',
                    "label"      => 'Url (Optional)',
                    "hideLabel"  => true,
                    "validators" => 'url',
                    "icon"       => 'fa-external-link'
                ],
                [
                    "value"      => '',
                    "name"       => 'description',
                    "label"      => 'Description (Optional)',
                    "hideLabel"  => true,
                    "validators" => '',
                    "icon"       => ''
                ],
            ],
            "partners" => [
                [
                    "value"       => '',
                    "name"        => 'name',
                    "label"       => 'Name',
                    "hideLabel"   => true,
                    "validators"  => '',
                    "icon"        => 'fa-hospital-o',
                    "isFullWidth" => true,
                    'options'     => PartnerOrganization::orderBy( 'name' )
                                                       ->get()
                ],
                [
                    "value"      => '',
                    "name"       => 'website',
                    "label"      => 'Website (Optional)',
                    "hideLabel"  => true,
                    "validators" => 'url',
                    "icon"       => 'fa-external-link'
                ]
            ],
            "visitedLocations" => [
                [
                    "value"      => '',
                    "name"       => 'locality',
                    "label"      => 'City',
                    "hideLabel"  => true,
                    "validators" => '',
                    "icon"       => ''
                ],
                [
                    "value"      => '',
                    "name"       => 'administrativeAreaLevel1',
                    "label"      => 'State',
                    "hideLabel"  => true,
                    "validators" => '',
                    "icon"       => ''
                ],
                [
                    "value"      => '',
                    "name"       => 'country',
                    "label"      => 'Country',
                    "hideLabel"  => true,
                    "validators" => '',
                    "icon"       => ''
                ]
            ]
        ];

        foreach( OutreachProgram::$default_fields as $name => $label ){

            $fields['additionalFields'][] = [

                "name"       => $name,
                "label"      => $label,
                "validators" => ''
            ];
        }

        return response()->json([

            'success' => true,
            'data' => $fields
        ]);
    }
}
