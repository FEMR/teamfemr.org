<?php

    namespace FEMR\Http\Controllers\Admin;

    use FEMR\Data\Models\OutreachProgram;
    use FEMR\Data\Models\School;
    use FEMR\Http\Controllers\Controller;
    use FEMR\Http\Requests\Admin\ProgramRequest;

    class ProgramController extends Controller
    {
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
            $school->programs()->create( $request->all() );

            return redirect()->route( 'admin.programs.index', [ $school->id ] );
        }

        /**
         * @param School $school
         * @param OutreachProgram $program
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function edit( School $school, OutreachProgram $program )
        {
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
