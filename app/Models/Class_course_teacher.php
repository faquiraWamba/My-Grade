<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Class_course_teacher extends Model
{
    use HasFactory;
    protected $fillable= ['class_course_id', 'teacher_course_id'];
    public function class_course()
    {
        return $this->belongsTo(Class_Course::class);
    }

    public function course_teachers()
    {
        return $this->belongsTo(Course_teacher::class, 'teacher_course_id');
    }
}
