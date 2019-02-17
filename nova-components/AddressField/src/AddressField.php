<?php

namespace FEMR\AddressField;

use Laravel\Nova\Fields\Field;

class AddressField extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'address-field';

    public function __construct( string $name, ?string $attribute = null, ?mixed $resolveCallback = null )
    {
        parent::__construct( $name, $attribute, $resolveCallback );

        // Google Place fields to model
        return $this->withMeta([
                   'address' => 'address',
                   'address_ext' => 'address_ext',
                   'locality' => 'locality',
                   'administrative_area_level_1' => 'administrative_area_level_1',
                   'postal_code' => 'postal_code',
                   'country' => 'country',
                   'latitude' => 'latitude',
                   'longitude' => 'longitude'
            ]);
    }
}
