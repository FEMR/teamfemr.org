<?php

namespace FEMR\Data\Models;

use FEMR\Data\Utilities\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class School extends Model
{
    use SoftDeletes, HasSlug;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'schools';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'has_trips',
        'address',
        'address_ext',
        'locality',
        'administrative_area_level_1',
        'administrative_area_level_2',
        'postal_code',
        'country',
        'latitude',
        'longitude',
        'notes'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'name'                        => 'string',
        'slug'                        => 'string',
        'has_trips'                   => 'boolean',
        'address'                     => 'string',
        'address_ext'                 => 'string',
        'locality'                    => 'string',
        'administrative_area_level_1' => 'string',
        'administrative_area_level_2' => 'string',
        'postal_code'                 => 'string',
        'country'                     => 'string',
        'latitude'                    => 'double',
        'longitude'                   => 'double',
        'notes'                       => 'string'
    ];

    /**
     * The attributes that should not be encoded to json
     *
     * @var array
     */
    protected $hidden = [

        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * Returns the full address formatted as an html string
     *
     * @return string
     */
    public function getFullAddressAttribute()
    {
        $address = $this->address . '<br />';

        if( !empty( $this->address_ext ) )
        {
            $address .= $this->address_ext . '<br />';
        }

        $address .= $this->locality . ', ' . $this->administrative_area_level_1 . ' ' . $this->postal_code;

        return $address;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function outreachPrograms()
    {
        return $this->hasMany( OutreachProgram::class );
    }

    /**
     * Alias for outreachPrograms
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function programs()
    {
        return $this->outreachPrograms();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function medias()
    {
        return $this->morphMany( Media::class, 'mediaable' );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function contacts()
    {
        return $this->belongsToMany( Contact::class );
    }
}
