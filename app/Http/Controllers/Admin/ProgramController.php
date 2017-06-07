<?php

    namespace FEMR\Http\Controllers\Admin;

    use FEMR\Data\Criteria\OutreachProgram\NewestFirstWithSchool;
    use FEMR\Data\Criteria\OutreachProgram\TrashedForSchool;
    use FEMR\Data\Models\OutreachProgram;
    use FEMR\Data\Models\School;
    use FEMR\Http\Controllers\Controller;
    use FEMR\Http\Requests\Admin\ProgramRequest;

    class ProgramController extends Controller
    {

        /**
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function all()
        {
            $programs = OutreachProgram::applyCriteria( new NewestFirstWithSchool() )->paginate( 50 );

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
            /** @var OutreachProgram $program */
            $program = $school->programs()->create( $request->all() );

            if( $request->has( 'school_classes' ) )
            {
                $program->syncSchoolClasses( $request->input( 'school_classes' ) );
            }

            if( $request->has( 'additional_fields' ) )
            {
                $program->syncAdditionalFields( $request->input( 'additional_fields' ) );
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
            $program->update( $request->all() );

            if( $request->has( 'school_classes' ) )
            {
                $program->syncSchoolClasses( $request->input( 'school_classes' ) );
            }

            if( $request->has( 'additional_fields' ) )
            {
                $program->syncAdditionalFields( $request->input( 'additional_fields' ) );
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
            OutreachProgram::
                applyCriteria( new TrashedForSchool( $school_id, $program_id ))
                ->findOrFail( $program_id )
                ->restore();

            return redirect()->route( 'admin.programs.index', [ $school_id ] );
        }
    }
