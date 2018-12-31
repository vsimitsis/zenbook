<?php

namespace App\Http\Middleware;

use App\Company;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CheckType
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
        if (empty($request->companySubDomain)) {
            return $next($request);
        }

        $company = Company::where('subdomain', $request->companySubDomain)->first();

        if (!$company) {
            throw new NotFoundHttpException();
        }

        $user = Auth::user();

        $requestParams = $request->all();
        $requestParams['currentCompany'] = $company;
        $requestParams['currentUser'] = $user;
        $request->replace($requestParams);

        View::share([
            'currentCompany' => $company,
            'currentUser'    => $user
        ]);


        return $next($request);
    }
}
