<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable=['startAt','status','person_id'];

    public function people()
    {
        return $this->belongsTo(Person::class,'person_id');
    }
    public function course_teachers()
    {
        return $this->hasMany(Course_teacher::class);
    }
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_teachers');
    }
}
