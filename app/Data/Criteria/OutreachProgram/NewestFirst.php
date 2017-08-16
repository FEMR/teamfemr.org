<?php

namespace FEMR\Data\Criteria\OutreachProgram;

use FEMR\Data\Criteria\Criteria;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class NewestFirst
 * @package FEMR\Data\Criteria\OutreachProgram
 */
class NewestFirst implements Criteria
{

    /**
     * ForSchool constructor.
     * 
     */
    public function __construct()
    {
        //
    }

    /**
     * @param Builder $query
     * @return mixed
     */
    public function apply( Builder $query )
    {
        return $query->orderBy( 'created_at', 'desc' );
    }

}