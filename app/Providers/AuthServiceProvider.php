<?php

namespace FEMR\Providers;

use Illuminate\Auth\TokenGuard;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'FEMR\Model' => 'FEMR\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        //
        // Cheaply gating the admin section to admin users
        //  TODO - More involved roles and policies implemented later
        //
        Gate::define( 'view-admin', function( $user ){

            return $user->is_admin;
        });

        // To update a survey, a user must be assigned to that survey or be an admin
        Gate::define( 'update-survey', function ( $user, $survey ) {

            return ( $survey->users->pluck( 'id' )->contains( $user->id ) || $user->is_admin );
        });
    }
}
