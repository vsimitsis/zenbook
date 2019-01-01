<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class AuthorizeCompanyAccess
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
        $user = $request->currentUser;

        if ($user && ($user->status !== User::SUSPENDED) && $user->can('access', $request->currentCompany)) {
            return $next($request);
        }

        if ($user) {
            Auth::guard()->logout();
        }

        return redirect(route('login'))
            ->withErrors([
                'unauthorized' => 'You are not authorized to access this company.'
            ]);
    }
}
