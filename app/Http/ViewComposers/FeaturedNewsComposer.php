<?php

namespace FEMR\Http\ViewComposers;

use FEMR\Data\Models\News;
use Illuminate\View\View;

class FeaturedNewsComposer
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
        $view->with('featured_news', News::where('is_featured', 1)->orderBy('created_at', 'desc')->take(10)->get());
    }
}