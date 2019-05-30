<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SectionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the user is authorized to create a section
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return !$user->isStudent();
    }
}
