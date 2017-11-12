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
     * Always eager load these relationships
     *
     * @var array
     */
    protected $with = [ 'users' ];

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
        'uses_emr',
        'comments'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'school_name' => 'string',
        'slug' => 'string',
        'year_initiated' => 'string',
        'yearly_outreach_participants' => 'string',
        'matriculants_per_class' => 'string',
        'months_of_travel' => 'string',
        'uses_emr' => 'boolean',
        'comments' => 'string'
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
        'faculty-and-staffing' => 'Faculty and staffing:',
        'application-process' => 'Application process:',
        'program-elements' => 'Program elements:',
        'financial-support' => 'Financial support:',
        'faculty-time-alotted' => 'Faculty time allotted:',
        'administrative-support' => 'Administrative support:'
    ];

    /**
     * Grabs a value by $key from the fields relationship
     *
     * @param $key
     *
     * @return null
     */
    public function getAdditionalFieldValue( $key )
    {
        if ( $this->fields->count() > 0 ) {
            $field = $this->fields->filter(
                function ( $item ) use ( $key ) {
                    return $item->key === $key;
                } )
                                  ->first();

            if ( $field ) {
                return $field->value;
            }
        }
        return null;
    }

    /**
     * @param array $months
     */
    public function setMonthsOfTravelAttribute( $months = [] )
    {
        // TODO - handle this more appropriately?
        if( is_array( $months ) )
        {
            $this->attributes['months_of_travel'] = implode( ",", $months );
        }
        else
        {
            $this->attributes['months_of_travel'] = $months;
        }

    }

    /**
     * @return array
     */
    public function getMonthsOfTravelAttribute()
    {
        // TODO - handle this more appropriately?
        if( strlen( $this->attributes['months_of_travel'] ) > 0 ) {

            return explode( ",", $this->attributes['months_of_travel'] );
        }
        else return [];
    }

    /**
     * @return array
     */
    public function getMonthsOfTravelStringAttribute()
    {
        return $this->attributes['months_of_travel'];
    }

    /**
     * @return string
     */
    public function getVisitedLocationsCenterAttribute()
    {

        $center_lat = 0.0;
        $center_lng = 0.0;
        foreach ( $this->visitedLocations as $location ) {

            $center_lat += $location->latitude;
            $center_lng += $location->longitude;

        };

        $center_lat = $center_lat / $this->visitedLocations->count();
        $center_lng = $center_lng / $this->visitedLocations->count();

        return json_encode(
            [

                'lat' => $center_lat,
                'lng' => $center_lng

            ] );
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
     * @param $query
     *
     * @return mixed
     */
    public function scopeWithAll( $query )
    {
        return $query->with(
            [
                'medias',
                'contacts',
                'schoolClasses',
                'visitedLocations' => function ( $query ) {

                    $query->orderBy( 'country' );
                },
                'fields',
                'papers',
                'partnerOrganizations'
            ]
        );
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
     * @param array $additional_fields
     *
     * @return $this
     */
    public function syncAdditionalFields( $additional_fields = [] )
    {
        if( ! is_array( $additional_fields ) ) return $this;

        foreach ( $additional_fields as $key => $value ) {
            // Don't add fields that are blank
            if ( strlen( trim( $value ) ) === 0 ) continue;

            if ( $this->fields->contains( 'key', $key ) ) {
                $this->fields()
                     ->where( 'key', '=', $key )
                     ->update( [ 'value' => $value ] );
            }
            else {
                $this->fields()
                     ->create(
                         [
                             'name' => OutreachProgram::$default_fields[$key],
                             'key' => $key,
                             'value' => $value
                         ] );
            }
        }

        return $this;
    }

    /**
     * @param array $contacts
     *
     * @return $this
     */
    public function syncContacts( $contacts = [] )
    {
        if( ! is_array( $contacts ) ) return $this;

        // get existing contacts
        $existing_ids = $this->contacts->pluck( 'id' );

        foreach( $contacts as $contact )
        {
            if( isset( $contact['id'] ) && ! empty( $contact['id'] ) )
            {
                // remove encountered contacts from existing_ids
                $existing_ids = $existing_ids->filter( function( $value, $key ) use( $contact )
                {
                    return $value !== intval( $contact['id'] );
                });

                $this->contacts()
                    ->findOrFail( $contact['id'] )
                    ->update( $contact );
            }
            else
            {
                $this->contacts()->create( $contact );
            }
        }

        // remove existing ids not encountered in $contacts
        $this->contacts()->detach( $existing_ids );

        return $this;
    }

    /**
     * @param array $papers
     *
     * @return $this
     */
    public function syncPapers( $papers = [] )
    {
        if( ! is_array( $papers ) ) return $this;

        // get existing papers
        $existing_ids = $this->papers->pluck( 'id' );

        foreach( $papers as $paper )
        {
            if( isset( $paper['id'] ) && ! empty( $paper['id'] ) )
            {
                // remove encountered papers from existing_ids
                $existing_ids = $existing_ids->filter( function( $value, $key ) use( $paper )
                {
                   return $value !== intval( $paper['id'] );
                });

                $this->papers()
                     ->findOrFail( $paper['id'] )
                     ->update( $paper );
            }
            else
            {
                $this->papers()->create( $paper );
            }
        }

        // remove existing ids not encountered in $papers
        foreach( $existing_ids as $to_delete )
        {
            $this->papers()->findOrFail( $to_delete )->delete();
        }

        return $this;
    }

    /**
     * @param array $school_classes
     *
     * @return $this
     */
    public function syncSchoolClasses( $school_classes = [] )
    {
        if( ! is_array( $school_classes ) ) return $this;
        $classes_to_sync = [];

        foreach ( $school_classes as $class ) {

            if ( is_numeric( $class ) ) {
                $classes_to_sync[] = $class;
            }
            else {
                $existing = SchoolClass::where( 'name', 'LIKE', $class )->first();

                //
                // Add school class and get id to sync
                //
                if ( is_null( $existing ) ) {
                    $new = $this->schoolClasses()->create( [ 'name' => $class ] );
                    $classes_to_sync[] = $new->id;
                }
                else {
                    $classes_to_sync[] = $existing->id;
                }
            }
        }

        $this->schoolClasses()->sync( $classes_to_sync );

        return $this;
    }

    /**
     * @param array $partners
     *
     * @return $this
     */
    public function syncPartnerOrganizations( $partners = [] )
    {
        if( ! is_array( $partners ) ) return $this;

        // get existing partners
        $existing_ids = $this->partnerOrganizations->pluck( 'id' );

        foreach( $partners as $partner )
        {
            if( isset( $partner['id'] ) && ! empty( $partner['id'] ) )
            {
                // remove encountered papers from existing_ids
                $existing_ids = $existing_ids->filter( function( $value, $key ) use( $partner )
                {
                    return $value !== intval( $partner['id'] );
                });

                $this->partnerOrganizations()
                     ->findOrFail( $partner['id'] )
                     ->update( $partner );
            }
            else
            {
                $this->partnerOrganizations()->create( $partner );
            }
        }

        // remove existing ids not encountered in $partners
        $this->partnerOrganizations()->detach( $existing_ids );

        return $this;
    }

    /**
     * @param array $visited_locations
     *
     * @return $this
     */
    public function syncVisitedLocations( $visited_locations = [] )
    {
        if( ! is_array( $visited_locations ) ) return $this;

        // get existing locations
        $existing_ids = $this->visitedLocations->pluck( 'id' );

        foreach( $visited_locations as $location )
        {
            if( isset( $location['id'] ) && ! empty( $location->id ) )
            {
                // remove encountered locations from existing_ids
                $existing_ids = $existing_ids->filter( function( $value, $key ) use( $location )
                {
                    return $value !== intval( $location['id'] );
                });

                $this->visitedLocations()
                     ->findOrFail( $location->id )
                     ->update( $location );
            }
            else
            {
                $this->visitedLocations()->create( $location );
            }
        }

        // remove existing ids not encountered in $visited_locations
        foreach( $existing_ids as $to_delete )
        {
            $this->visitedLocations()->findOrFail( $to_delete )->delete();
        }

        return $this;
    }
}
