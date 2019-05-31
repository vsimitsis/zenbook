<?php

namespace App\Http\Requests;

use App\Section;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SectionRequest extends FormRequest
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
        return [
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string|max:600',
            'visibility'  => [
                'required',
                'integer',
                Rule::in(Section::VISIBLE, Section::HIDDEN)
            ]
        ];
    }

    /**
     * Get custom validation error messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'        => __('rules.name_required'),
            'name.max'             => __('rules.name_max'),
            'description.required' => __('rules.description_required'),
            'description.max'      => __('rules.description_max'),
        ];
    }
}
