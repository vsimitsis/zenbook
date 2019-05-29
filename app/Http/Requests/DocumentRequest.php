<?php

namespace App\Http\Requests;

use App\Document;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class DocumentRequest extends FormRequest
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
            'name'   => 'nullable|string|max:255',
            'access' => [
                'required',
                'integer',
                Rule::in([
                    Document::PUBLIC_ACCESS,
                    Document::SHARED_ACCESS,
                    Document::PRIVATE_ACCESS
                ])
            ],
            'user_access' => [
                'required_if:access,' . Document::SHARED_ACCESS,
                'nullable',
                'array',
                Rule::in(Auth::user()->company->users->pluck('id'))
            ],
            'document' => 'required|file',
        ];
    }

    /**
     * Return custom validation error messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'access.required'          => __('rules.access.required'),
            'access.integer'           => __('rules.access.integer'),
            'name.max'                 => __('rules.filename_max'),
            'user_access.required_if'  => __('rules.user_access_required'),
            'document.required'        => __('rules.document_required'),
        ];
    }
}
