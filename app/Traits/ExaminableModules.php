<?php

namespace App\Traits;

use App\Choice;
use App\Http\Requests\ModuleRequest;
use App\Module;
use App\MultipleChoice;
use App\QuestionAnswer;
use PhpParser\Node\Expr\AssignOp\Mod;

trait ExaminableModules
{
    /**
     * Return the examinable module
     *
     * @param ModuleRequest $request
     * @return mixed
     */
    protected function createExaminableModel(ModuleRequest $request)
    {
        switch ($request->module_type) {
            case 'App\\QuestionAnswer':
                return $this->createQuestionAnswerModule($request);
                break;
            case 'App\\MultipleChoice':
                return $this->createMultiChoiceModule($request);
                break;
        }
    }

    /**
     * Create a questionAnswer module
     *
     * @param ModuleRequest $request
     * @return mixed
     */
    protected function createQuestionAnswerModule(ModuleRequest $request)
    {
        return QuestionAnswer::create([
            'question'          => $request->qa_question,
            'grade'             => $request->grade,
            'max_answer_length' => $request->max_answer_length
        ]);
    }

    /**
     * Create multiple choice module and it's choices
     *
     * @param ModuleRequest $request
     * @return mixed
     */
    protected function createMultiChoiceModule(ModuleRequest $request)
    {
        $multipleChoice = MultipleChoice::create([
            'question' => $request->mc_question,
            'grade'    => $request->grade,
        ]);

        if ($request->get('choices')) {
            foreach ($request->get('choices') as $choice) {
                Choice::create([
                    'multiple_choice_id' => $multipleChoice->id,
                    'body'               => $choice['choice'],
                    'grade'              => $choice['grade']
                ]);
            }
        }

        return $multipleChoice;
    }

    /**
     * Update the examinable module
     *
     * @param ModuleRequest $request
     * @param Module $module
     * @return mixed
     */
    protected function updateExaminableModel(ModuleRequest $request, Module $module)
    {
        $module->name       = $request->name;
        $module->section_id = $request->section_id;
        $module->save();

        switch ($request->module_type) {
            case 'App\\QuestionAnswer':
                return $this->updateQuestionAnswerModule($request, $module);
                break;
            case 'App\\MultipleChoice':
                return $this->updateMultiChoiceModule($request, $module);
                break;
        }
    }

    /**
     * Create a questionAnswer module
     *
     * @param ModuleRequest $request
     * @param Module $module
     * @return mixed
     */
    protected function updateQuestionAnswerModule(ModuleRequest $request, Module $module)
    {
        $questionAnswer = $module->examinable;

        $questionAnswer->question          = $request->qa_question;
        $questionAnswer->grade             = $request->grade;
        $questionAnswer->max_answer_length = $request->max_answer_length;
        $questionAnswer->save();

        return $questionAnswer;
    }

    /**
     * Update multiple choice module and it's choices
     *
     * @param ModuleRequest $request
     * @param Module $module
     * @return mixed
     */
    protected function updateMultiChoiceModule(ModuleRequest $request, Module $module)
    {
        $multipleChoice = $module->examinable;

        $multipleChoice->question          = $request->mc_question;
        $multipleChoice->grade             = $request->grade;
        $multipleChoice->save();

        $multipleChoice->choices()->delete();

        if ($request->get('choices')) {
            foreach ($request->get('choices') as $choice) {
                Choice::create([
                    'multiple_choice_id' => $multipleChoice->id,
                    'body'               => $choice['choice'],
                    'grade'              => $choice['grade']
                ]);
            }
        }

        return $multipleChoice;
    }
}