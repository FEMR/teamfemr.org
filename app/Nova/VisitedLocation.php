<?php

namespace FEMR\Nova;

use Laravel\Nova\Fields\ID;
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
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return 'Visited Locations';
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request): array
    {
        return [
            ID::make()
                ->sortable()
                ->onlyOnDetail(),

//            AddressField::make( 'Address')
//                        ->rules('string'),

            Text::make('Address Ext')
                ->sortable()
                ->rules('max:255')
                ->hideFromIndex(),

            Text::make('City', 'locality')
                ->sortable()
                ->rules('max:255'),

            Text::make('State Code', 'administrative_area_level_1')
                ->sortable()
                ->rules('max:255'),

            Text::make('Administrative Area Level 2')
                ->sortable()
                ->rules('max:255')
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

//            MapField::make('map', function(){
//                return [
//                        'lat' => $this->latitude ?? 0.0,
//                        'lng' => $this->longitude ?? 0.0
//                    ];
//                })
//                ->onlyOnDetail()
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request): array
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request): array
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request): array
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request): array
    {
        return [];
    }
}
