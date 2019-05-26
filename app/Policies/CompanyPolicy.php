<?php

namespace App\Policies;

use App\Company;
use App\userRole;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the user can access the company
     *
     * @param User $user
     * @param Company $company
     * @return mixed
     */
    public function access(User $user, Company $company)
    {
        return $user->company->is($company);
    }

    /**
     * Determine if the user is authorized to administrate the company
     *
     * @param User $user
     * @param Company $company
     * @return bool
     */
    public function administrate(User $user, Company $company)
    {
        return $user->company->is($company) && $user->user_role_id === userRole::ADMINISTRATOR;
    }

    /**
     * Determine if the user is authorized to manage the company
     *
     * @param User $user
     * @param Company $company
     * @return bool
     */
    public function manage(User $user, Company $company)
    {
        return $user->company->is($company) && $user->user_role_id <= userRole::TEACHER;
    }
}
