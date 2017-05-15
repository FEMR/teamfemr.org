<?php

    namespace FEMR\Http\Controllers\Admin;

    use FEMR\Data\Models\OutreachProgram;
    use FEMR\Data\Models\Paper;
    use FEMR\Data\Models\School;
    use FEMR\Http\Controllers\Controller;
    use FEMR\Http\Requests\Admin\PaperRequest;

    class PaperController extends Controller
    {

        /**
         * @param School $school
         * @param OutreachProgram $program
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function index( School $school, OutreachProgram $program )
        {
            return view( 'admin.programs.papers.index', [ 'school' => $school, 'program' => $program ] );
        }

        /**
         * @param School $school
         * @param OutreachProgram $program
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function archived( School $school, OutreachProgram $program )
        {
            $papers = $program->papers()->onlyTrashed()->get();
            $program->setRelation( 'papers', $papers );

            return view( 'admin.programs.papers.archived', [ 'school' => $school, 'program' => $program ] );
        }

        /**
         * @param School $school
         * @param OutreachProgram $program
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function create( School $school, OutreachProgram $program )
        {
            return view( 'admin.programs.papers.create', [ 'school' => $school, 'program' => $program ] );
        }

        /**
         * @param $school_id
         * @param OutreachProgram $program
         * @param PaperRequest $request
         * @return \Illuminate\Http\RedirectResponse
         */
        public function store( $school_id, OutreachProgram $program, PaperRequest $request )
        {
            $paper = $program->papers()->create( $request->all() );

            return redirect()->route( 'admin.papers.index', [ $school_id, $program->id ] );
        }

        /**
         * @param School $school
         * @param OutreachProgram $program
         * @param Paper $paper
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function edit( School $school, OutreachProgram $program, Paper $paper )
        {
            return view( 'admin.programs.papers.edit', [ 'school' => $school, 'program' => $program, 'paper' => $paper ] );
        }

        /**
         * @param $school_id
         * @param $program_id
         * @param Paper $paper
         * @param PaperRequest $request
         * @return \Illuminate\Http\RedirectResponse
         */
        public function update( $school_id, $program_id, Paper $paper, PaperRequest $request )
        {
            $paper->update( $request->all() );

            return redirect()->route( 'admin.papers.index', [ $school_id, $program_id ] );
        }

        /**
         * @param $school_id
         * @param $program_id
         * @param Paper $paper
         * @return \Illuminate\Http\RedirectResponse
         */
        public function destroy( $school_id, $program_id, Paper $paper )
        {
            $paper->delete();

            return redirect()->route( 'admin.papers.index', [ $school_id, $program_id ]);
        }

        /**
         * @param $school_id
         * @param $program_id
         * @param $paper_id
         * @return \Illuminate\Http\RedirectResponse
         */
        public function restore( $school_id, $program_id, $paper_id )
        {
            $paper = Paper::where( 'outreach_program_id', '=', $program_id )
                        ->withTrashed()
                        ->findOrFail( $paper_id );
            $paper->restore();

            return redirect()->route( 'admin.papers.index', [ $school_id, $program_id ] );
        }
    }