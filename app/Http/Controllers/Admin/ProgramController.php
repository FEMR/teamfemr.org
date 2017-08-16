<?php

    namespace FEMR\Http\Controllers\Admin;

    use FEMR\Data\Criteria\OutreachProgram\NewestFirst;
    use FEMR\Data\Models\OutreachProgram;
    use FEMR\Http\Controllers\Controller;
    use FEMR\Http\Requests\Admin\ProgramRequest;

    class ProgramController extends Controller
    {

        /**
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function index()
        {
            $programs = OutreachProgram::applyCriteria( new NewestFirst() )->paginate( 50 );

            return view( 'admin.programs.index', [ 'programs' => $programs ] );
        }

        /**
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function archived()
        {

            $programs = OutreachProgram::onlyTrashed()->get();

            return view( 'admin.programs.archived', [ 'programs' => $programs ] );
        }

        /**
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function create()
        {
            return view( 'admin.programs.create' );
        }

        /**
         * @param ProgramRequest $request
         * @return \Illuminate\Http\RedirectResponse
         */
        public function store( ProgramRequest $request )
        {
            /** @var OutreachProgram $program */
            $program = OutreachProgram::create( $request->all() );

            if( $request->has( 'school_classes' ) )
            {
                $program->syncSchoolClasses( $request->input( 'school_classes' ) );
            }

            if( $request->has( 'additional_fields' ) )
            {
                $program->syncAdditionalFields( $request->input( 'additional_fields' ) );
            }

            return redirect()->route( 'admin.programs.edit', [ $program->id ] );
        }

        /**
         * @param OutreachProgram $program
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function edit( OutreachProgram $program )
        {
            $program->load( 'schoolClasses' );
            return view( 'admin.programs.edit', [ 'program' => $program ] );
        }

        /**
         * @param OutreachProgram $program
         * @param ProgramRequest $request
         * @return \Illuminate\Http\RedirectResponse
         */
        public function update( OutreachProgram $program, ProgramRequest $request )
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

            session()->flash( 'message', [ 'type' => 'is-success', 'message' => 'Updated Successfully' ]);

            return redirect()->route( 'admin.programs.edit', [ $program->id ] );
        }

        /**
         * @param OutreachProgram $program
         * @return \Illuminate\Http\RedirectResponse
         * @throws \Exception
         */
        public function destroy( OutreachProgram $program )
        {
            $program->delete();

            return redirect()->route( 'admin.programs.index' );
        }

        /**
         * @param $program_id
         * @return \Illuminate\Http\RedirectResponse
         */
        public function restore( $program_id )
        {
            OutreachProgram::withTrashed()
                ->findOrFail( $program_id )
                ->restore();

            return redirect()->route( 'admin.programs.index' );
        }
    }
