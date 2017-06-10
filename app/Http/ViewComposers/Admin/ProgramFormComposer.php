<?php

    namespace FEMR\Http\ViewComposers\Admin;

    use FEMR\Data\Models\School;
    use FEMR\Data\Models\SchoolClass;
    use Illuminate\View\View;

    class ProgramFormComposer
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
            $view->with( 'school_classes', SchoolClass::pluck( 'name', 'id' )->all() );
            $view->with( 'schools',        School::orderBy( 'name' )->pluck( 'name', 'id' )->all() );
        }
    }