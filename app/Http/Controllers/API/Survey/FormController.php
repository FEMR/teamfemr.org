<?php

namespace FEMR\Http\Controllers\API\Survey;

use FEMR\Data\Models\OutreachProgram;
use FEMR\Data\Models\SchoolClass;
use FEMR\Http\Controllers\Controller;

class FormController extends Controller
{


    public function show()
    {
        $fields = [

            "program_name" => [

                "name"       => 'program_name',
                "label"      => 'Title of Program',
                "validators" => ''
            ],
            "school_name" => [

                "name"       => 'school_name',
                "label"      => 'Name of School',
                "validators" => ''
            ],
            "uses_emr" => [

                "name"        => 'uses_emr',
                "label"       => 'Do you use an emr?',
                "placeholder" => 'Please select',
                "validators"  => 'required',
                "options"     => [

                    "yes" => 'Yes',
                    "no"  => 'No'
                ],
                "isFullWidth" => true
            ],
            "year_initiated" => [

                "name"       => 'year_initiated',
                "label"      => 'Year Initiated',
                "validators" => ''
            ],
            "participants_per_year" => [

                "name"       => 'participants_per_year',
                "label"      => 'Total participants in global health outreach per year',
                "validators" => ''
            ],
            "months_of_travel" => [

                "name"       => 'months_of_travel',
                "label"      => 'Month(s) of Travel',
                "validators" => ''
            ],
            "matriculants_per_class" => [

                "name"       => 'matriculants_per_class',
                "label"      => 'Total number of matriculants per class',
                "validators" => ''
            ],
            "school_classes" => [

                "name"       => 'school_classes',
                "label"      => 'Medical school student class involvement (M1, M2, M3, M4)',
                "validators" => '',
                'isFullWidth' => true,
                "options"    =>  SchoolClass::select( 'name', 'slug' )
                                            ->orderBy( 'name' )
                                            ->get()
                                            ->map( function( $class )
                                            {
                                                return [ 'label' => $class->name, 'value' => $class->slug ];
                                            })
            ],
            "additional_fields" => [],
            "contacts" => [

                [
                    "name"       => 'name',
                    "label"      => 'Name',
                    "value"      => '',
                    "hideLabel"  => true,
                    "validators" => 'required',
                    "icon"       => 'fa-user'
                ],
                [
                    "value"      => '',
                    "name"       => 'email',
                    "label"      => 'Email (Optional)',
                    "hideLabel"  => true,
                    "validators" => 'email',
                    "icon"       => 'fa-envelope-o'
                ],
                [
                    "value"      => '',
                    "name"       => 'phone',
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
                    "value"      => '',
                    "name"       => 'name',
                    "label"      => 'Name',
                    "hideLabel"  => true,
                    "validators" => '',
                    "icon"       => 'fa-hospital-o'
                ],
                [
                    "value"      => '',
                    "name"       => 'url',
                    "label"      => 'Url (Optional)',
                    "hideLabel"  => true,
                    "validators" => 'url',
                    "icon"       => 'fa-external-link'
                ]
            ],
            "locations" => [
                [
                    "value"      => '',
                    "name"       => 'city',
                    "label"      => 'City',
                    "hideLabel"  => true,
                    "validators" => '',
                    "icon"       => ''
                ],
                [
                    "value"      => '',
                    "name"       => 'state',
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

            $fields['additional_fields'][] = [

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
