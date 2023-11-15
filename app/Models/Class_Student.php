<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Class_Student extends Model
{
    use HasFactory;
    protected $fillable=['student_id','classe_id','school_year','report_card'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }
    public function course_students()
    {
        return $this->hasMany(Course_student::class,'class_student_id');
    }
    public function class_courses()
    {
        return $this->belongsToMany(Class_Course::class,'course_students','class_student_id','class_course_id');
    }
}
