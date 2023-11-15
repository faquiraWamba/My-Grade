<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Class_Course extends Model
{
    use HasFactory;
    protected $fillable=['class_id','course_id','semester', 'school_year'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class, 'class_id');
    }
    public function class_course_teachers()
    {
        return $this->hasMany(Class_course_teacher::class,'class_course_id');
    }
    public function course_student()
    {
        return $this->hasMany(Course_student::class,'class_course_id');
    }
    public function course_teacher()
    {
        return $this->belongsToMany(Course_teacher::class,'class_course_teachers','class_course_id','teacher_course_id');
    }
    

}
