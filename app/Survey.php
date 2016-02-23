<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
        protected $fillable = [

            'teamname', //these things can be mass assigned
            'initiated',
            'totalmatriculants',
                'medschoolterms',
                'aidingschools',
                'totalperyear',
                'visitedlocale',
                'monthsoftravel',
                'partnerngo',
                'faculty',
                'appprocess',
                'programelements',
                'finsupport',
                'facultytimeallotted',
                'adminsupport',
                'contactinfo',
                'lat',
                'lng'
        ];
}
