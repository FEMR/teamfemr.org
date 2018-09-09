<?php

namespace FEMR\Http\Controllers\Admin\Program;

use Carbon\Carbon;
use FEMR\Data\Models\OutreachProgram;
use FEMR\Data\Repositories\OutreachProgramRepository;
use FEMR\Http\Controllers\Controller;

class ApproveController extends Controller
{
    /**
     * @param $outreach_program_id
     *
     * @param OutreachProgramRepository $repository
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store( $outreach_program_id, OutreachProgramRepository $repository )
    {
        $program = $repository->findOrFail( $outreach_program_id );
        $repository->approve($program);

        return redirect()->route('admin.programs.index' )
                         ->with( 'message', [ 'type' => 'is-success', 'message' => $program->name . ' was Approved' ] );
    }

    /**
     * @param $outreach_program_id
     *
     * @param OutreachProgramRepository $repository
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($outreach_program_id, OutreachProgramRepository $repository)
    {
        $user_id = auth()->user()->id;
        $program = $repository->findOrFail($outreach_program_id, $user_id);
        $repository->disapprove($program);

        return redirect()->route( 'admin.programs.index' )
                         ->with( 'message', [ 'type' => 'is-success', 'message' => $program->name . ' was Unapproved' ] );
    }
}
