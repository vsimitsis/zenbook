<?php

namespace App\Policies;

use App\User;
use App\UserRole;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClassroomPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the user is able to create a classroom
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->userRole->id === UserRole::ADMINISTRATOR;
    }
}
