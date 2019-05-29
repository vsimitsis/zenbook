<?php

namespace App\Http\Requests;

use App\Document;
use Illuminate\Foundation\Http\FormRequest;
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
            'original_filename' => 'nullable|string|max:255',
            'access' => [
                'required',
                'integer',
                Rule::in([
                    Document::PUBLIC_ACCESS,
                    Document::SHARED_ACCESS,
                    Document::PRIVATE_ACCESS
                ])
            ],
            'document' => 'required|file',
        ];
    }
}
