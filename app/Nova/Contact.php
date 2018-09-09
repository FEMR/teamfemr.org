<?php

namespace FEMR\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Contact extends Resource
{
    /**
     * @var bool
     */
    public static $displayInNavigation = true;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'FEMR\Data\Models\Contact';

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
        'first_name',
        'last_name',
        'full_name',
        'email',
        'phone'
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

            Text::make('prefix')
                ->rules('max:255')
                ->onlyOnForms(),

            Text::make('first_name')
                ->rules('max:255')
                ->onlyOnForms(),

            Text::make('last_name')
                ->rules('max:255')
                ->onlyOnForms(),

            Text::make('full_name')
                ->rules('max:255')
                ->resolveUsing(function($full_name){

                    return empty($full_name) ? $this->first_name .' '.$this->last_name : $full_name;
                }),

            Text::make('suffix')
                ->rules('max:255')
                ->onlyOnForms(),

            Text::make('title')
                ->rules('max:255')
                ->onlyOnForms(),

            Text::make('phone')
                ->rules('max:255'),

            Text::make('email')
                ->rules('max:255', 'email'),

            Textarea::make('notes')
                ->rules('string')
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
