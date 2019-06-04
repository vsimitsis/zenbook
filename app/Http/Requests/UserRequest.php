<?php

namespace App\Http\Requests;

use App\userRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'first_name' => 'required|string|min:3|max:55',
            'last_name'  => 'required|alpha|min:3|max:55',
            'user_role' => [
                'required',
                'integer',
                Rule::in(userRole::all()->pluck('id'))
            ],
            'contact-list' => 'nullable|array',
            'address-list' => 'nullable|array',
        ];

        if ($this->method() == 'PUT') {
            $rules['email'] = 'required|email|max:255|unique:users,email,' . $this->user->id;
        } else {
            $rules['email'] = 'required|email|max:255|unique:users,email';
        }

        if ($this->request->get('contact-list')) {
            foreach ($this->request->get('contact-list') as $key => $contact) {
                $rules['contact-list.'.$key.'.email'] = 'nullable|email|max:255';
                $rules['contact-list.'.$key.'.mobile'] = 'nullable|string|max:35';
                $rules['contact-list.'.$key.'.landline'] = 'nullable|string|max:35';
            }
        }

        if ($this->request->get('address-list')) {
            foreach ($this->request->get('address-list') as $key => $contact) {
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
            'first_name.required'         => __('rules.first_name_required'),
            'first_name.min'              => __('rules.first_name_min'),
            'first_name.max'              => __('rules.first_name_max'),
            'last_name_required'          => __('rules.last_required'),
            'last_name.min'               => __('rules.last_name_min'),
            'last_name.max'               => __('rules.last_name_max'),
            'contact-list.*.email.max'    => __('rules.email_max'),
            'contact-list.*.mobile.max'   => __('rules.mobile_max'),
            'contact-list.*.landline.max' => __('rules.landline_max'),
            'address-list.*.address1.max' => __('rules.address1.max'),
            'address-list.*.address2.max' => __('rules.address2.max'),
            'address-list.*.postcode.max' => __('rules.postcode.max'),
            'address-list.*.city.max'     => __('rules.city.max'),
        ];
    }
}
