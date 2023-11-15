<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course_teacher extends Model
{
    use HasFactory;
    protected $fillable =['teacher_id', 'course_id'];

   
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    public function class_course_teachers()
    {
        return $this->hasMany(Class_course_teacher::class,'teacher_course_id');
    }
}
