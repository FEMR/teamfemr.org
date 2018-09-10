<?php

namespace FEMR\Http\ViewComposers;

use FEMR\Data\Models\Publication;
use Illuminate\View\View;

class LatestPublicationsComposer
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
        $view->with('publications', Publication::orderBy('created_at', 'asc')->take(10)->get());
    }
}