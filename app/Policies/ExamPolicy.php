<?php

namespace App\Policies;

use App\Exam;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExamPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the user can edit an exam
     *
     * @param User $user
     * @param Exam $exam
     * @return bool
     */
    public function view(User $user, Exam $exam)
    {
        return !$user->isStudent(); //TODO Or if the student is assigned
    }

    /**
     * Determine if the user can edit an exam
     *
     * @param User $user
     * @param Exam $exam
     * @return bool
     */
    public function edit(User $user, Exam $exam)
    {
        return !$user->isStudent();
    }

    /**
     * Determine if the user can create an exam
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return !$user->isStudent();
    }

    /**
     * Determine if the user can delete the exam record
     *
     * @param User $user
     * @param Exam $exam
     * @return bool
     */
    public function destroy(User $user, Exam $exam)
    {
        return $user->isAdmin() || $user->exams->contains($exam);
    }
}
