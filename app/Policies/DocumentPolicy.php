<?php

namespace App\Policies;

use App\Document;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DocumentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the user is authorized to edit this user account
     *
     * @param User $user
     * @param Document $document
     * @return bool
     */
    public function edit(User $user, Document $document)
    {
        return $document->user->is($user);
    }
}
