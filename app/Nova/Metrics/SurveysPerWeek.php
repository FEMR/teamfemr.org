<?php

namespace FEMR\Nova\Metrics;

use FEMR\Data\Models\OutreachProgram;
use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Trend;

class SurveysPerWeek extends Trend
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function calculate(Request $request)
    {
        return $this->countByWeeks($request, OutreachProgram::class);
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges()
    {
        return [
            4 => '1 Month',
            8 => '3 Months',
            24 => '6 Months',
        ];
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
        return now()->addMinutes(20);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'surveys-per-week';
    }
}
