<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
                'faculty',
                'appprocess',
                'programelements',
                'finsupport',
                'facultytimeallotted',
                'adminsupport',
                'contactinfo',
                'approved'
        ];

//        public function places()
//        {
//                return $this->belongsToMany('App\Place')->withPivot('trip_id');
//        }
        public function trips()
        {
                return $this->hasMany('App\Trip');
        }
        public function user()
        {
                return $this->hasMany('App\User');
        }
        use SoftDeletes;

        protected $dates = ['deleted_at'];
}
