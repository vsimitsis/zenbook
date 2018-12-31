<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $this->user->id,
            'contact-list' => 'array',
            'address-list' => 'array',
        ];

        if ($this->request->get('contact-list')) {
            foreach ($this->request->get('contact-list') as $key => $contact) {
                $rules['contact-list.'.$key.'.email'] = 'nullable|email|max:255';
                $rules['contact-list.'.$key.'.mobile'] = 'nullable|string|max:35';
                $rules['contact-list.'.$key.'.landline'] = 'nullable|string|max:35';
            }
        }

        if ($this->request->get('address-list')) {
            foreach ($this->request->get('contact-list') as $key => $contact) {
                $rules['address-list.'.$key.'.building_name'] = 'required|string|max:255';
                $rules['address-list.'.$key.'.address1'] = 'nullable|string|max:255';
                $rules['address-list.'.$key.'.address2'] = 'nullable|string|max:255';
                $rules['address-list.'.$key.'.postcode'] = 'nullable|string|max:35';
                $rules['address-list.'.$key.'.city'] = 'nullable|string|max:255';
                $rules['address-list.'.$key.'.country'] = 'nullable|integer';
            }
        }

        return $rules;
    }

    /**
     * Custom error messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'contact-list.0.email.max' => 'The contact email must be max 255 characters.',
            'contact-list.0.mobile.max' => 'The contact mobile number must be max 35 characters.',
            'contact-list.0.landline.max' => 'The contact landline number be max 35 characters.',
            'address-list.0.building_name.max' => 'The building name must be max 255 characters.',
            'address-list.0.address1.max' => 'The address 1 must be max 255 characters.',
            'address-list.0.address2.max' => 'The address 2 must be max 255 characters.',
            'address-list.0.postcode.max' => 'The postcode must be max 35 characters.',
            'address-list.0.city.max' => 'The city must be max 255 characters.',
        ];
    }
}
