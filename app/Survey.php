<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
        //Model portion of the Model-View-Controller system
        //Variables that can be changed in the Trip Database table
        protected $fillable = [
            'teamname',
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
                'contactinfo'
        ];

        public function places()
        {
                return $this->belongsToMany('App\Place');
        }
}
