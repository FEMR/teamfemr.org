<?php

namespace FEMR\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class OutreachProgramResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [

            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'schoolName' => $this->school_name,
            'usesEmr' => $this->uses_emr,
            'matriculantsPerClass' => $this->matriculants_per_class,
            'yearInitiated' => $this->year_initiated,
            'yearlyOutreachParticipants' => $this->yearly_outreach_participants,
            'monthsOfTravel' => $this->months_of_travel,
            'comments' => $this->comments,
            'lastUpdated' => $this->updated_at->format( 'm/d/Y h:i a T' ),
//            'additionalFields' => $this->fields->map( function( $field ) {
//
//                return [
//
//                    'id' => $field->id,
//                    'name' => $field->name,
//                    'key' => $field->key,
//                    'value' => $field->value
//                ];
//            }),
            'additionalFields' => $this->fields->pluck( 'value', 'key' ),
            'schoolClasses' => $this->schoolClasses->map( function( $class ) {

                return [

                    'id' => $class->id,
                    'name' => $class->name,
                    'slug' => $class->slug
                ];
            }),
            'contacts' => $this->contacts->map( function( $contact ) {

                return [

                    'id' => $contact->id,
                    'firstName' => $contact->first_name,
                    'lastName' => $contact->last_name,
                    'fullName' => $contact->full_name,
                    'phone' => $contact->phone,
                    'email' => $contact->email
                ];
            }),
            'partnerOrganizations' => $this->partnerOrganizations->map( function( $partner ) {

                return [

                    'id' => $partner->id,
                    'name' => $partner->name,
                    'slug' => $partner->slug,
                    'website' => $partner->website
                ];
            }),
            'papers' => $this->papers->map( function( $paper ) {

                return [

                    'id' => $paper->id,
                    'title' => $paper->title,
                    'description' => $paper->description,
                    'url' => $paper->url
                ];
            }),
            'visitedLocations' => $this->visitedLocations->map( function( $location ) {

                return [

                    'id' => $location->id,
                    'cityStateCountry' => $location->city_state_country,
                    'address' => $location->title,
                    'addressExt' => $location->addressExt,
                    'locality' => $location->locality,
                    'administrativeAreaLevel1' => $location->administrative_area_level_1,
                    'administrativeAreaLevel2' => $location->administrative_area_level_2,
                    'postal_code' => $location->postal_code,
                    'country' => $location->country,
                    'latitude' => $location->latitude,
                    'longitude' => $location->longitude
                ];
            })
        ];
    }
}
