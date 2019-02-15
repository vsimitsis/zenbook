<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
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
        $user = Auth::user();

        if ($user->status === User::SUSPENDED) {
            Auth::logout();

            return redirect(route('login'))
                ->withErrors([
                    'userStatusError' => 'Your account has been suspended. For further information contact your company.'
                ]);
        }

        return $next($request);
    }
}
