<?php

namespace FEMR\Nova\Dashboards;

use FEMR\Nova\Metrics\MostVisitedCountries;
use FEMR\Nova\Metrics\NewUsers;
use FEMR\Nova\Metrics\SurveysPerWeek;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Dashboards\Main as Dashboard;

class Main extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array<int, \Laravel\Nova\Card>
     */
    public function cards(): array
    {
        return [
            new NewUsers,
            new SurveysPerWeek,
            (new MostVisitedCountries)->width('2/3'),
        ];
    }
}
