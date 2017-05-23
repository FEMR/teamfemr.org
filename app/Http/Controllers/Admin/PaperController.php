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
         * @param $program_id
         */
        public function index( $program_id )
        {
            return Paper::where( 'outreach_program_id', '=', $program_id )->get();
        }

        /**
         * @param $program_id
         * @param PaperRequest $request
         * @return \Illuminate\Http\RedirectResponse
         */
        public function store( $program_id, PaperRequest $request )
        {
            $program = OutreachProgram::findOrFail( $program_id );
            return $program->papers()->create( $request->all() );
        }

        /**
         * @param $program_id
         * @param $paper_id
         * @param PaperRequest $request
         * @return \Illuminate\Http\RedirectResponse
         */
        public function update( $program_id, $paper_id, PaperRequest $request )
        {
            $paper = Paper::where( 'outreach_program_id', '=', $program_id )->findOrFail( $paper_id );
            return [

                'status' => $paper->update( $request->all() )
            ];
        }

        /**
         * @param $program_id
         * @param $paper_id
         * @return \Illuminate\Http\RedirectResponse
         */
        public function destroy( $program_id, $paper_id )
        {
            return [

                'status' => Paper::where( 'outreach_program_id', '=', $program_id )->findOrFail( $paper_id )->delete()
            ];
        }

        /**
         * @param $program_id
         * @param $paper_id
         * @return \Illuminate\Http\RedirectResponse
         */
        public function restore( $program_id, $paper_id )
        {
            $paper = Paper::where( 'outreach_program_id', '=', $program_id )
                        ->withTrashed()
                        ->findOrFail( $paper_id );

            return $paper->restore();
        }
    }