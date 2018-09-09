<?php

namespace FEMR\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Place;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class VisitedLocation extends Resource
{
    /**
     * @var bool
     */
    public static $displayInNavigation = false;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'FEMR\Data\Models\VisitedLocation';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'address',
        'address_ext',
        'locality',
        'administrative_area_level_1',
        'administrative_area_level_2',
        'postal_code',
        'country'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()
                ->sortable()
                ->onlyOnDetail(),


            Place::make('Address','address')
                ->secondAddressLine('address_ex')
                ->city('locality')
                ->state('administrative_area_level_1')
                ->postalCode('postal_code')
                ->country('country')
                ->sortable()
                ->rules('max:255')
                ->hideFromIndex(),

            Text::make('Address Ext')
                ->sortable()
                ->rules('max:255')
                ->hideFromIndex(),

            Text::make('City', 'locality')
                ->sortable()
                ->rules('max:255'),

            Text::make('State Code', 'administrative_area_level_1')
                ->sortable()
                ->rules('max:2'),

            Text::make('Administrative Area Level 2')
                ->sortable()
                ->rules('max:2')
                ->hideFromIndex(),

            Text::make('Postal Code')
                ->sortable()
                ->rules('max:255')
                ->hideFromIndex(),

            Text::make('Country')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Latitude')
                ->sortable()
                ->rules('required', 'numeric')
                ->hideFromIndex(),

            Text::make('Longitude')
                ->sortable()
                ->rules('required', 'numeric')
                ->hideFromIndex(),

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
