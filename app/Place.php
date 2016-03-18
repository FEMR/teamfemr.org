<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = [

        'lat',
        'lng',
        'place'
    ];

    public function surveys()
    {

        return $this->belongsToMany('App\Survey');
    }


}