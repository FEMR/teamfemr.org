<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class literature extends Model
{
    //Model portion of the Model-View-Controller system
    //Variables that can be changed in the Literature table
        protected $fillable = [

        'contributorName',
        'authorName',
        'addLink'
];
}
