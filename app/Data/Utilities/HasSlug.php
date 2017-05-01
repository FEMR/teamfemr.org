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
            // TODO - we should probably set some better rules for this process, but this works to start
            //
            if( ! empty( $entity->name ) )
            {
                //
                // Make sure the slug is unique
                //
                $ct = 1;
                $slug = Str::slug( $entity->name );
                while( $previous = static::where( 'slug', '=', $slug )->withTrashed()->first() != null )
                {
                    $slug = Str::slug( $entity->name ) . '-' . $ct++;
                }

                $entity->slug = $slug;
            }

            return $entity;
        });

    }
}