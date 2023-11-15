<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;
    protected $fillable=['level','description','speciality_id'];

    public function specialities()
    {
        return $this->hasOne(Speciality::class);
    }
    public function class_students()
    {
        return $this->hasMany(Class_Student::class);
    }
    public function class_courses()
    {
        return $this->hasMany(Class_Course::class,'class_id');
    }
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'class__courses','class_id','course_id');
    }

    public function speciality()
    {
        return $this->belongsTo(Speciality::class);  
    }
    public function students()
    {
        return $this->belongsToMany(Student::class, 'class__students');
    }

}
