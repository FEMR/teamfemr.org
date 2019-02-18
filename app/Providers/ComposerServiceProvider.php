<?php

namespace FEMR\Providers;

use FEMR\Http\ViewComposers\AnnualReportsListComposer;
use FEMR\Http\ViewComposers\FeaturedNewsComposer;
use FEMR\Http\ViewComposers\LatestPublicationsComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('sections.publications', LatestPublicationsComposer::class);
        View::composer('sections.news', FeaturedNewsComposer::class);
        View::composer('partials.annual-reports-list', AnnualReportsListComposer::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
