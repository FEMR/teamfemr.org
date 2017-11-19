<?php

namespace FEMR\Data\Scopes;

use FEMR\Data\Models\User;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class IsApprovedScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        // TODO -- how to get the user for multiple guards in a better way than this?
        $user = auth('api')->user();
        if( ! $user ) $user = auth('web' )->user();

        if( ! ( $user && $user->is_admin ) ) {

            $builder->whereNotNull('approved_at' );
        }
        else if( $user ) {

            if( ! $user->is_admin )
            {
                $builder->whereHas( 'user', function ( $query ) use ( $user )
                {
                    $query->where( 'id', '=', $user->id );
                } );
            }
        }
    }
}