<?php

namespace App\Providers;

use App\Company;
use App\Document;
use App\Exam;
use App\Policies\CompanyPolicy;
use App\Policies\DocumentPolicy;
use App\Policies\ExamPolicy;
use App\Policies\UserPolicy;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Company::class  => CompanyPolicy::class,
        User::class     => UserPolicy::class,
        Document::class => DocumentPolicy::class,
        Exam::class     => ExamPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
