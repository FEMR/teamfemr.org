<?php

namespace FEMR\Http\ViewComposers\Admin;

use FEMR\Data\Models\School;
use FEMR\Data\Models\SchoolClass;
use Illuminate\View\View;

class AdminMessageComposer
{
    /**
     * Create a new classes composer.
     */
    public function __construct()
    {

    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if( session()->has( 'message' ) )
        {
            $message = session( 'message' );
            $view->with( 'admin_message', (object) $message );
        }
    }
}