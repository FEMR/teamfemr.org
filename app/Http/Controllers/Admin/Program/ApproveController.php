<?php

namespace FEMR\Http\Controllers\Admin\Program;

use Carbon\Carbon;
use FEMR\Data\Models\OutreachProgram;
use FEMR\Http\Controllers\Controller;

class ApproveController extends Controller
{
    /**
     * @param $outreach_program_id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store( $outreach_program_id )
    {
        $program = OutreachProgram::findOrFail( $outreach_program_id );
        $program->approved_by = auth()->user()->id;
        $program->approved_at = Carbon::now();
        $program->save();

        return redirect()->route('admin.programs.index' )
                         ->with( 'message', [ 'type' => 'is-success', 'message' => $program->name . ' was Approved' ] );
    }

    /**
     * @param $outreach_program_id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy( $outreach_program_id )
    {
        $program = OutreachProgram::findOrFail( $outreach_program_id );
        $program->approved_by = null;
        $program->approved_at = null;
        $program->save();

        return redirect()->route( 'admin.programs.index' )
                         ->with( 'message', [ 'type' => 'is-success', 'message' => $program->name . ' was Unapproved' ] );
    }
}
