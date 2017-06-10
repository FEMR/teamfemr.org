<?php

namespace FEMR\Providers;

use FEMR\Http\ViewComposers\Admin\AdminMessageComposer;
use FEMR\Http\ViewComposers\Admin\ProgramFormComposer;
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
        View::composer( 'admin.programs.partials.form.base-fields', ProgramFormComposer::class );
        View::composer( 'admin.partials.message', AdminMessageComposer::class );
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
