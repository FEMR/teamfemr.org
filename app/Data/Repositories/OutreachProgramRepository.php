<?php

namespace FEMR\Data\Repositories;

use Carbon\Carbon;
use FEMR\Data\Models\OutreachProgram;

class OutreachProgramRepository{

    /**
     * @param $program_id
     *
     * @return mixed
     */
    public function findOrFail($program_id){

        return OutreachProgram::findOrFail( $program_id );
    }

    /**
     * @param OutreachProgram $program
     *
     * @return mixed
     */
    public function approve($program, $user_id){

        $program->approved_by = $user_id;
        $program->approved_at = Carbon::now();
        return $program->save();
    }

    /**
     * @param OutreachProgram $program
     *
     * @return mixed
     */
    public function disapprove($program){

        $program->approved_by = null;
        $program->approved_at = null;
        return $program->save();
    }
}