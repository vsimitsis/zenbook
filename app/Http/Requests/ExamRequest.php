<?php

namespace App\Http\Requests;

use App\Exam;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ExamRequest extends FormRequest
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
            'name'   => 'required|string|max:255',
            'status' => [
                'required',
                'integer',
                Rule::in([Exam::OPEN_STATUS, Exam::CLOSED_STATUS])
            ]
        ];
    }

    /**
     * Return custom messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'   => __('rules.exam_name_required'),
            'name.max'        => __('rules.exam_name_max'),
            'status.required' => __('rules.exam_status_required'),
        ];
    }
}
