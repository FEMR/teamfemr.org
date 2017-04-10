<?php

namespace FEMR\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VisitedLocation extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'visited_locations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address',
        'address_ext',
        'locality',
        'administrative_area_level_1',
        'administrative_area_level_2',
        'postal_code',
        'country',
        'latitude',
        'longitude',
        'start_date',
        'end_date'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'address'                     => 'string',
        'address_ext'                 => 'string',
        'locality'                    => 'string',
        'administrative_area_level_1' => 'string',
        'administrative_area_level_2' => 'string',
        'postal_code'                 => 'string',
        'country'                     => 'string',
        'latitude'                    => 'double',
        'longitude'                   => 'double',
        'start_date'                  => 'date',
        'end_date'                    => 'date'
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function outreachProgram()
    {
        return $this->belongsTo( OutreachProgram::class );
    }
}
