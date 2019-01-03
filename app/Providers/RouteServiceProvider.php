<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        $domain = config('app.domain');

        Route::middleware(['web', 'checkType', 'forgetDomain'])
            ->domain($domain)
            ->name('home.')
            ->namespace($this->namespace . '\Home')
            ->group(base_path('routes/web.php'));

        Route::middleware(['web', 'checkType', 'forgetDomain'])
            ->domain('{companySubDomain}.' . $domain)
            ->namespace($this->namespace)
            ->group(function () {
                Auth::routes();
            });

        Route::middleware(['web', 'checkType', 'auth', 'forgetDomain'])
            ->domain('{companySubDomain}.' . $domain)
            ->namespace($this->namespace)
            ->group(base_path('routes/company.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}
