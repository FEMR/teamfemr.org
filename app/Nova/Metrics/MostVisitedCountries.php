<?php

namespace FEMR\Nova\Metrics;

use FEMR\Data\Models\VisitedLocation;
use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Partition;

class MostVisitedCountries extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function calculate(Request $request)
    {
        return $this->count(
            $request,
            VisitedLocation::orderBy('aggregate','desc')->take(5),
            'country'
        );
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
        //return now()->addMinutes(10);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'most-visited-locations';
    }
}
