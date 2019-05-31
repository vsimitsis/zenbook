<?php

namespace App\Traits;

use App\Exam;

trait ParentClass
{
    /**
     * Get the parent class
     *
     * @param string $parent_type
     * @param string $parent_id
     * @return string|null
     */
    protected function getParentClass(string $parent_type, string $parent_id)
    {
        switch ($parent_type) {
            case 'exams':
                return Exam::find($parent_id);
                break;
            default:
                break;
        }
    }
}