<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class PassViewData
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
        if (Auth::user()) {
            $user    = Auth::user();
            $company = $user->company;
        } else {
            $user = null;
            $settings = null;
        }

        View::share(['currentUser' => $user, 'currentCompany' => $company]);

        return $next($request);
    }
}
