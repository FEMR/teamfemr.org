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
        $user = \Auth::user();
        if( ! ( $user && $user->is_admin ) ) {

            $builder->whereNotNull('approved_at' );
        }


    }
}