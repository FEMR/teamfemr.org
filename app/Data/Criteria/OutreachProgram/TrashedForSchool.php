<?php

namespace FEMR\Data\Criteria\OutreachProgram;

use FEMR\Data\Criteria\Criteria;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class TrashedForSchool
 * @package FEMR\Data\Criteria\OutreachProgram
 */
class TrashedForSchool implements Criteria
{
    /**
     * @var int
     */
    private $school_id;

    /**
     * @var int
     */
    private $program_id;

    /**
     * ForSchool constructor.
     * @param $school_id
     * @param $program_id
     */
    public function __construct( $school_id, $program_id )
    {
        $this->school_id = $school_id;
        $this->program_id = $program_id;
    }

    /**
     * @param Builder $query
     * @return mixed
     */
    public function apply( Builder $query )
    {
        return $query->where( 'school_id', '=', $this->school_id )
                    ->where( 'id', '=', $this->program_id )
                    ->withTrashed();
    }

}