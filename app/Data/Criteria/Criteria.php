<?php

    namespace FEMR\Data\Criteria;

    use Illuminate\Database\Eloquent\Builder;

    interface Criteria
    {
        /**
         * @param Builder $query
         * @return mixed
         */
        public function apply( Builder $query );
    }