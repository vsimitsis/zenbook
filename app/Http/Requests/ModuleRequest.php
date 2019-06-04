<?php

namespace App\Http\Requests;

use App\ModuleType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ModuleRequest extends FormRequest
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
            'name'        => 'required|string|max:255',
            'module_type' => [
                'required',
                'string',
                Rule::in(ModuleType::all()->pluck('type'))
            ],
            'grade'       => 'required|integer|min:-100|max:100',
            'visibility'  => 'required|boolean',
            'max_answer_length' => 'nullable|integer|min:1',
        ];

        if ($this->request->get('module_type') == 'App\\MultipleChoice') {
            $rules['mc_question'] = 'required|string|max:1500';
            $rules['choices']     = 'required|array';

            if ($this->request->get('choices')) {
                foreach ($this->request->get('choices') as $key => $choice) {
                    $rules['choices.'.$key.'.choice'] = 'nullable|string';
                    $rules['choices.'.$key.'.grade'] = 'nullable|integer|min:-100|max:100';
                }
            }
        } else if ($this->request->get('module_type') == 'App\\QuestionAnswer') {
            $rules['qa_question'] = 'required|string|max:1500';
        }

        return $rules;
    }

    /**
     * Return custom validation messages
     *
     * @return array|void
     */
    public function messages()
    {
        return [
            'name.required'       => __('rules.name_required'),
            'name.unique'         => __('rules.name_unique'),
            'name.max'            => __('rules.name_max'),
            'grade.required'      => __('rules.grade_required'),
            'grade.min'           => __('rules.grade_min'),
            'grade.max'           => __('rules.grade_max'),
            'visibility.required' => __('rules.visibility_required'),
            'question.required'   => __('rules.question_required'),
            'question.max'        => __('rules.question_max'),
        ];
    }
}
