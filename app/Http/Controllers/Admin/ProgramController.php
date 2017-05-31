<?php

    namespace FEMR\Http\Controllers\Admin;

    use FEMR\Data\Models\OutreachProgram;
    use FEMR\Data\Models\School;
    use FEMR\Data\Models\SchoolClass;
    use FEMR\Http\Controllers\Controller;
    use FEMR\Http\Requests\Admin\ProgramRequest;

    class ProgramController extends Controller
    {

        /**
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function all()
        {
            $programs = OutreachProgram::orderBy( 'created_at', 'desc' )
                                        ->with( 'school' )
                                        ->paginate( 50 );

            return view( 'admin.programs.all', [ 'programs' => $programs ] );
        }

        /**
         * @param School $school
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function index( School $school )
        {
            return view( 'admin.programs.index', [ 'school' => $school ] );
        }

        /**
         * @param School $school
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function archived( School $school )
        {

            $programs = $school->programs()->onlyTrashed()->get();
            $school->setRelation( 'programs', $programs );

            return view( 'admin.programs.archived', [ 'school' => $school ] );
        }

        /**
         * @param School $school
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function create( School $school )
        {
            return view( 'admin.programs.create', [ 'school' => $school ] );
        }

        /**
         * @param School $school
         * @param ProgramRequest $request
         * @return \Illuminate\Http\RedirectResponse
         */
        public function store( School $school, ProgramRequest $request )
        {

            $program = $school->programs()->create( $request->all() );

            if( $request->has( 'school_classes' ) )
            {
                $classes_to_sync = [];

                foreach( $request->input( 'school_classes' ) as $class )
                {
                    if( is_numeric( $class ) )
                    {
                        $classes_to_sync[] = $class;
                    }
                    else
                    {
                        $existing = SchoolClass::where( 'name', '=', $class )->first();

                        //
                        // Add school class and get id to sync
                        //
                        if( is_null( $existing ) )
                        {
                            $new = SchoolClass::create([ 'name' => $class ]);
                            $classes_to_sync[] = $new->id;
                        }
                        else
                        {
                            $classes_to_sync[] = $existing->id;
                        }

                    }
                }

                $program->schoolClasses()->sync( $classes_to_sync );
            }

            if( $request->has( 'additional_fields' ) )
            {
                foreach( $request->input( 'additional_fields' ) as $key => $value )
                {
                    if( $program->fields->contains( 'key', $key ) )
                    {
                        $program->fields()
                            ->where( 'key', '=', $key )
                            ->update([ 'value' => $value ]);
                    }
                    else
                    {
                        $program->fields()
                            ->create([
                                'name'   => OutreachProgram::$default_fields[ $key ],
                                'key'    => $key,
                                'value' => $value
                            ]);
                    }
                }
            }

            return redirect()->route( 'admin.programs.edit', [ $school->id, $program->id ] );
        }

        /**
         * @param School $school
         * @param OutreachProgram $program
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function edit( School $school, OutreachProgram $program )
        {
            $program->load( 'schoolClasses' );
            return view( 'admin.programs.edit', [ 'school' => $school, 'program' => $program ] );
        }

        /**
         * @param School $school
         * @param OutreachProgram $program
         * @param ProgramRequest $request
         * @return \Illuminate\Http\RedirectResponse
         */
        public function update( School $school, OutreachProgram $program, ProgramRequest $request )
        {
            // TODO - move this to a repository
            $program->update( $request->all() );

            if( $request->has( 'school_classes' ) )
            {
                $classes_to_sync = [];

                foreach( $request->input( 'school_classes' ) as $class )
                {
                    if( is_numeric( $class ) )
                    {
                        $classes_to_sync[] = $class;
                    }
                    else
                    {
                        $existing = SchoolClass::where( 'name', '=', $class )->first();

                        //
                        // Add school class and get id to sync
                        //
                        if( is_null( $existing ) )
                        {
                            $new = SchoolClass::create([ 'name' => $class ]);
                            $classes_to_sync[] = $new->id;
                        }
                        else
                        {
                            $classes_to_sync[] = $existing->id;
                        }
                    }
                }

                $program->schoolClasses()->sync( $classes_to_sync );
            }

            if( $request->has( 'additional_fields' ) )
            {
                foreach( $request->input( 'additional_fields' ) as $key => $value )
                {
                    if( $program->fields->contains( 'key', $key ) )
                    {
                        $program->fields()
                                ->where( 'key', '=', $key )
                                ->update([ 'value' => $value ]);
                    }
                    else
                    {
                        $program->fields()
                                ->create([
                                    'name'   => OutreachProgram::$default_fields[ $key ],
                                    'key'    => $key,
                                    'value' => $value
                                ]);
                    }
                }
            }

            return redirect()->route( 'admin.programs.index', [ $school->id ] );
        }

        /**
         * @param School $school
         * @param OutreachProgram $program
         * @return \Illuminate\Http\RedirectResponse
         * @throws \Exception
         */
        public function destroy( School $school, OutreachProgram $program )
        {
            $program->delete();

            return redirect()->route( 'admin.programs.index', [ $school->id ]);
        }

        /**
         * @param $school_id
         * @param $program_id
         * @return \Illuminate\Http\RedirectResponse
         */
        public function restore( $school_id, $program_id )
        {
            $program = OutreachProgram::where( 'school_id', '=', $school_id )
                            ->where( 'id', '=', $program_id )
                            ->withTrashed()
                            ->findOrFail( $program_id );
            $program->restore();

            return redirect()->route( 'admin.programs.index', [ $school_id ] );
        }
    }
