<?php

namespace App\Traits;

use App\Classroom;
use App\Document;
use App\Exam;
use Illuminate\Support\Facades\Auth;

trait UniqueNames
{
    /**
     * Determine the class and call the corresponding functionality
     *
     * @param $request
     * @param null $model
     * @return string
     */
    protected function renameIfExists($request, $model = null) :string
    {
        switch (get_class($model)) {
            case 'App\\Document':
                return $this->renameDocument($request, $model);
                break;
            case 'App\\Exam':
                return $this->renameExam($request, $model);
                break;
            case 'App\\Classroom':
                return $this->renameClassroom($request, $model);
                break;

        }
    }

    /**
     * Check if a document with this filename exists in that company and rename it
     *
     * @param $request
     * @param Document|null $document
     * @return string
     */
    protected function renameDocument($request, Document $document = null) : string
    {
        $fileName   = $request->name ?: $request->file('document')->getClientOriginalName();
        $countQuery = Auth::user()->company->documents()->where('original_filename', 'LIKE', $fileName . '%');

        if ($document->id) {
            $countQuery = $countQuery->where('id', '!=', $document->id);
        }

        $count = $countQuery->count();

        if ($count) {
            $fileName .= "-$count";
        }

        return $fileName;
    }

    /**
     * Check if an exam with this name exists in that company and rename it
     *
     * @param $request
     * @param Exam|null $exam
     * @return string
     */
    protected function renameExam($request, Exam $exam = null) :string
    {
        $name       = $request->name;
        $countQuery = Auth::user()->company->exams()->where('name', 'LIKE', $name . '%');

        if ($exam->id) {
            $countQuery = $countQuery->where('id', '!=', $exam->id);
        }

        $count = $countQuery->count();

        if ($count) {
            $name .= "-$count";
        }

        return $name;
    }

    /**
     * Check if a classroom with this name exists in that company and rename it
     *
     * @param $request
     * @param Classroom $classroom
     * @return string
     */
    protected function renameClassroom($request, Classroom $classroom) :string
    {
        $name       = $request->name;
        $countQuery = Auth::user()->company->classrooms()->where('name', 'LIKE', $name . '%');

        if ($classroom->id) {
            $countQuery = $countQuery->where('id', '!=', $classroom->id);
        }

        $count = $countQuery->count();

        if ($count) {
            $name .= "-$count";
        }

        return $name;
    }
}