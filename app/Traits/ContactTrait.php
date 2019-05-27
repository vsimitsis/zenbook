<?php

namespace App\Traits;

use App\Contact;
use App\Http\Requests\UserRequest;
use App\User;

trait ContactTrait
{
    /**
     * Remove and re attach all the new contacts
     *
     * @param UserRequest $request
     * @param User $user
     * @param boolean $update
     */
    public function storeContacts(UserRequest $request, User $user, $update = false)
    {
        if ($update) {
            $user->contacts()->delete();
        }

        if ($request->get('contact-list')) {
            foreach ($request->get('contact-list') as $newContact) {
                if ($this->arrayIsNull($newContact)) {
                    continue;
                }

                $contact = Contact::create([
                    'email' => $newContact['email'],
                    'mobile' => $newContact['mobile'],
                    'landline' => $newContact['landline']
                ]);

                $user->contacts()->attach($contact->id);
            }
        }
    }
}