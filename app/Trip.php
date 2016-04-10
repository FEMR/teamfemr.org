<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trip extends Model
{
    protected $fillable = [
        'partnerngo',
        'monthsoftravel',
        'survey_id'
    ];


    public function survey()
    {

        return $this->belongsTo('App\Survey');
    }
    public function place()
    {

        return $this->belongsTo('App\Place');
    }

    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
