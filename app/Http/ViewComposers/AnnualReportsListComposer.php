<?php

namespace FEMR\Http\ViewComposers;

use FEMR\Data\Models\AnnualReport;
use Illuminate\View\View;

class AnnualReportsListComposer
{
    /**
     * Create a new profile composer.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('annual_reports', AnnualReport::orderBy('created_at', 'asc')->take(5)->get());
    }
}