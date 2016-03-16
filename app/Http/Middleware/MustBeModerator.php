<?php

namespace App\Http\Middleware;

use Closure;

class MustBeModerator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
       $user = $request->user();

        if ($user && $user->moderator()) {
            return $next($request);
        }

        return redirect()->guest('login');
    }
}
