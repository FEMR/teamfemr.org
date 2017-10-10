<?php

namespace FEMR\Data\Models;

use Collective\Html\Eloquent\FormAccessible;
use FEMR\Data\Traits\UsesCriteria;
use FEMR\Data\Utilities\HasSlug;
use FEMR\Data\Models\OutreachProgram\Field;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OutreachProgram extends Model
{
    use SoftDeletes, HasSlug, FormAccessible, UsesCriteria;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'outreach_programs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'school_name',
        'slug',
        'year_initiated',
        'yearly_outreach_participants',
        'matriculants_per_class',
        'months_of_travel',
        'uses_emr'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'name'                         => 'string',
        'school_name'                  => 'string',
        'slug'                         => 'string',
        'year_initiated'               => 'string',
        'yearly_outreach_participants' => 'string',
        'matriculants_per_class'       => 'string',
        'months_of_travel'             => 'string',
        'uses_emr'                     => 'boolean'
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
     * The default long form fields
     * - down the road this might need its own table/ui
     *
     * @var array
     */
    public static $default_fields = [

        'other-participating-schools' => 'Other participating professional schools:',
        'faculty-and-staffing'   => 'Faculty and staffing:',
        'application-process'    => 'Application process:',
        'program-elements'       => 'Program elements:',
        'financial-support'      => 'Financial support:',
        'faculty-time-alotted'   => 'Faculty time allotted:',
        'administrative-support' => 'Administrative support:'
    ];

    /**
     * Grabs a value by $key from the fields relationship
     *
     * @param $key
     * @return null
     */
    public function getAdditionalFieldValue( $key )
    {
        if( $this->fields->count() > 0 )
        {
            $field = $this->fields->filter( function( $item ) use ( $key )
                {
                    return $item->key === $key;
                })
                ->first();

            if( $field )
            {
                return $field->value;
            }
        }
        return null;
    }

    /**
     * @return string
     */
    public function getVisitedLocationsCenterAttribute(){

        $center_lat = 0.0;
        $center_lng = 0.0;
        foreach( $this->visitedLocations as $location ){

            $center_lat += $location->latitude;
            $center_lng += $location->longitude;

        };

        $center_lat = $center_lat / $this->visitedLocations->count();
        $center_lng = $center_lng / $this->visitedLocations->count();

        return  json_encode([

                'lat' => $center_lat,
                'lng' => $center_lng

            ]);
    }

    /**
     * @param $query
     * @param $slug
     *
     * @return mixed
     */
    public function scopeSlug( $query, $slug )
    {
        return $query->where( 'slug', '=', $slug );
    }

    /**
     * @return mixed
     */
    public function formSchoolClassesAttribute()
    {
        return $this->getRelation( 'schoolClasses' )->pluck( 'id' )->all();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
//    public function school()
//    {
//        return $this->belongsTo( School::class );
//    }

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
        return $this->belongsToMany( Contact::class, 'outreach_program_contact' );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function locations()
    {
        return $this->visitedLocations();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function visitedLocations()
    {
        return $this->hasMany( VisitedLocation::class );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fields()
    {
        return $this->hasMany( Field::class );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function papers()
    {
        return $this->hasMany( Paper::class );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function schoolClasses()
    {
        return $this->belongsToMany( SchoolClass::class )->withPivot( 'class_size' );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function partnerOrganizations()
    {
        return $this->belongsToMany( PartnerOrganization::class, 'outreach_program_partner', 'outreach_program_id', 'partner_id' );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany( User::class );
    }

    /**
     * @param array $school_classes
     * @return $this
     */
    public function syncSchoolClasses( $school_classes = [] )
    {
        $classes_to_sync = [];

        foreach( $school_classes as $class )
        {
            if( is_numeric( $class ) )
            {
                $classes_to_sync[] = $class;
            }
            else
            {
                $existing = SchoolClass::where( 'name', 'LIKE', $class )->first();

                //
                // Add school class and get id to sync
                //
                if( is_null( $existing ) )
                {
                    $new = $this->schoolClasses()->create([ 'name' => $class ]);
                    $classes_to_sync[] = $new->id;
                }
                else
                {
                    $classes_to_sync[] = $existing->id;
                }

            }
        }

        $this->schoolClasses()->sync( $classes_to_sync );

        return $this;
    }

    /**
     * @param array $additional_fields
     * @return $this
     */
    public function syncAdditionalFields( $additional_fields = [] )
    {
        foreach( $additional_fields as $key => $value )
        {
            // Don't add fields that are blank
            if( strlen( trim( $value  ) ) === 0 ) continue;

            if( $this->fields->contains( 'key', $key ) )
            {
                $this->fields()
                    ->where( 'key', '=', $key )
                    ->update([ 'value' => $value ]);
            }
            else
            {
                $this->fields()
                    ->create([
                        'name'   => OutreachProgram::$default_fields[ $key ],
                        'key'    => $key,
                        'value' => $value
                    ]);
            }
        }

        return $this;
    }
}
