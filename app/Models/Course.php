<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable=['code','name','description','credit'];

    public function class_courses()
    {
        return $this->hasMany(Class_Course::class);
    }
    public function course_teachers()
    {
        return $this->hasMany(Course_teacher::class);
    }
    public function course_students()
    {
        return $this->hasMany(Course_student::class);
    }
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'course_teachers');
    }
    public function classes()
    {
        return $this->belongsToMany(Classe::class, 'class__courses','class_id','course_id');
    }
}
