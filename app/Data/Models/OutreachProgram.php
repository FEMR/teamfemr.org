<?php

namespace FEMR\Data\Models;

use Collective\Html\Eloquent\FormAccessible;
use FEMR\Data\Utilities\HasSlug;
use FEMR\Data\Models\OutreachProgram\Field;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OutreachProgram extends Model
{
    use SoftDeletes, HasSlug, FormAccessible;

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
        'slug',
        'year_initiated',
        'yearly_outreach_participants',
        'matriculants_per_class',
        'uses_emr'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'name'                         => 'string',
        'slug'                         => 'string',
        'year_initiated'               => 'integer',
        'yearly_outreach_participants' => 'integer',
        'matriculants_per_class'       => 'integer',
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

        'faculty-and-staffing'   => 'Faculty and staffing:',
        'application-process'    => 'Application process:',
        'program-elements'       => 'Program Elements:',
        'financial-support'      => 'Financial Support:',
        'faculty-time-alotted'   => 'Faculty Time Allotted:',
        'administrative-support' => 'Administrative Support:'
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
            $field = $this->fields->filter( function( $item, $key ) use ( $key )
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
     * @return mixed
     */
    public function formSchoolClassesAttribute()
    {
        return $this->getRelation( 'schoolClasses' )->pluck( 'id' )->all();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function school()
    {
        return $this->belongsTo( School::class );
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
        return $this->belongsToMany( Contact::class, 'outreach_program_contact' );
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

}
