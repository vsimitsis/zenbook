<?php

namespace App\Policies;

use App\userRole;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the user is authorized to create new user
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->user_role_id < userRole::STUDENT;
    }

    /**
     * Determine if the user is authorized to edit this user account
     *
     * @param User $user
     * @param User $profile
     * @return bool
     */
    public function edit(User $user, User $profile)
    {
        return $user->is($profile) ||
            ($user->company->is($profile->company) && $user->userRole->id < userRole::STUDENT);
    }
}
