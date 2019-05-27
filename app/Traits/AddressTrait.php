<?php

namespace App\Traits;

use App\Address;
use App\Http\Requests\UserRequest;
use App\User;

trait AddressTrait
{
    /**
     * Remove and re attach all the new addresses
     *
     * @param UserRequest $request
     * @param User $user
     * @param boolean $update
     */
    public function storeAddresses(UserRequest $request, User $user, $update = false)
    {
        if ($update) {
            $user->addresses()->delete();
        }

        if ($request->get('address-list')) {
            foreach ($request->get('address-list') as $newAddress) {
                if ($this->arrayIsNull($newAddress)) {
                    continue;
                }

                $address = Address::create([
                    'address1' => $newAddress['address1'],
                    'address2' => $newAddress['address2'],
                    'postcode' => $newAddress['postcode'],
                    'city' => $newAddress['city'],
                    'country_id' => isset($newAddress['country']) && $newAddress['country'] != 0 ? $newAddress['country'] : null,
                ]);

                $user->addresses()->attach($address->id);
            }
        }
    }
}