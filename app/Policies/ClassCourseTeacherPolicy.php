<?php

namespace App\Policies;

use App\Models\Class_course_teacher;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ClassCourseTeacherPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Class_course_teacher $classCourseTeacher): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Class_course_teacher $classCourseTeacher): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Class_course_teacher $classCourseTeacher): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Class_course_teacher $classCourseTeacher): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Class_course_teacher $classCourseTeacher): bool
    {
        //
    }
}