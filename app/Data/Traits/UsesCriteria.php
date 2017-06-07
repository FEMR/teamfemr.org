<?php

    namespace FEMR\Data\Traits;

    use FEMR\Data\Criteria\Criteria;

    trait UsesCriteria
    {

        /**
         * @param Criteria $criteria
         * @return mixed
         */
        public static function applyCriteria( Criteria $criteria )
        {
            //
            // Make sure method exists just in case
            //
            if( method_exists( static::class, 'query' ) )
            {
                return $criteria->apply( static::query() );
            }

            return new static;
        }
        
    }