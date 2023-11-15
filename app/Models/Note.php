<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    protected $fillable=['note','type','appreciation','status','modify','user_id','course_student_id','anonymity'];

    public function course_student()
    {
        return $this->belongsTo(Course_student::class);
    }
}
