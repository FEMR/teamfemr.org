<?php

namespace FEMR\Data\Utilities;

use Illuminate\Support\Str;

trait HasSlug
{

    /**
     * Observe model updates and ensure slug is set - generate from title if not
     */
    protected static function boot()
    {

        parent::boot();

        static::saving( function( $entity )
        {
            //
            // TODO - we should probably set some better rules for this process, but this works to starts
            //
            if( ! empty( $entity->name ) )
            {
                $entity->slug = Str::slug( $entity->name );
            }

            return $entity;
        });

    }
}