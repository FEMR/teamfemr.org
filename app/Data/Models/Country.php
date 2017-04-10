<?php

namespace FEMR\Data\Models;

use FEMR\Data\Utilities\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use SoftDeletes, HasSlug;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'countries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'official_name_en',
        'official_name_fr',
        'slug',
        'abbr',
        'code_2',
        'code_3',
        'population',
        'capital',
        'continent',
        'latitude',
        'longitude'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'name'             => 'string',
        'official_name_en' => 'string',
        'official_name_fr' => 'string',
        'slug'             => 'string',
        'code_2'           => 'string',
        'code_3'           => 'string',
        'population'       => 'integer',
        'capital'          => 'string',
        'continent'        => 'string',
        'latitude'         => 'double',
        'longitude'        => 'double'
    ];

    /**
     * @param $query
     * @param $code
     * @return mixed
     */
    public function scopeHasCode( $query, $code )
    {
        return $query->where( 'code_2', '=', $code );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cities()
    {
        return $this->hasMany( City::class );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function postals()
    {
        return $this->hasMany( Postal::class );
    }
}
