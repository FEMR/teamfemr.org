<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class literature extends Model
{
    protected $fillable = [

        'contributorName',
        'authorName',
        'addLink'
];
}
