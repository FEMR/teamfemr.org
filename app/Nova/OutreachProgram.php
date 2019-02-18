<?php

namespace FEMR\Nova;

use Carbon\Carbon;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use FEMR\TextField\TextField as Text;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class OutreachProgram extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'FEMR\Data\Models\OutreachProgram';

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
        'name'
    ];

    /**
     * The relationships that should be eager loaded on index queries.
     *
     * @var array
     */
    public static $with = ['schoolClasses'];

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return 'Outreach Programs';
    }

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

            Boolean::make('Is Approved', function(){
                return !is_null($this->approved_at) && $this->approved_at->isPast();
            }),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('School Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Locations', function () {
                    return $this->visitedLocations ? $this->visitedLocations->count() : 0;
                })
                ->onlyOnIndex(),

            Text::make('Partners', function () {
                    return ($this->partnerOrganizations) ? $this->partnerOrganizations->count() : 0;
                })
                ->onlyOnIndex(),

            Boolean::make('Uses Emr')
                   ->rules('required')
                   ->hideFromIndex(),

            Text::make('Year Initiated')
                ->rules('required', 'numeric')
                ->hideFromIndex(),

            Text::make('Yearly Participants', 'yearly_outreach_participants')
                ->rules('required', 'max:255')
                ->hideFromIndex(),

            Text::make('Matriculants Per Class')
                ->rules('required', 'max:255')
                ->hideFromIndex(),

            Textarea::make('Months of Travel')
                ->rules('required', 'max:255')
                ->hideFromIndex(),

            Textarea::make('Comments')
                ->rules('required')
                ->hideFromIndex(),

            HasMany::make('Fields'),

            BelongsToMany::make('PartnerOrganizations'),

            BelongsToMany::make('SchoolClasses'),

            HasMany::make('Papers'),

            HasMany::make('VisitedLocations'),

            BelongsToMany::make('Contacts'),

            BelongsToMany::make('Users')
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
        return [
            \App::make(Actions\ApproveOutreachProgram::class),
            \App::make(Actions\DisapproveOutreachProgram::class),
        ];
    }
}
