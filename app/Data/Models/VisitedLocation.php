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
     * The storage format of the model's date columns.
     *
     * @var string
     */
    protected $dateFormat = 'Y-m-d';

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
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [

        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * @param $start_date
     */
    public function setStartDateAttribute( $start_date )
    {
        if( empty( $start_date ) ) {

            $this->attributes['start_date'] = null;
        }
        else {

            $this->attributes['start_date'] = $start_date;
        }
    }

    /**
     * @param $start_date
     */
    public function setEndDateAttribute( $start_date )
    {
        if( empty( $start_date ) ) {

            $this->attributes['end_date'] = null;
        }
        else {

            $this->attributes['end_date'] = $start_date;
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function outreachProgram()
    {
        return $this->belongsTo( OutreachProgram::class );
    }
}
