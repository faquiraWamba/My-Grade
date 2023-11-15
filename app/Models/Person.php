<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    protected $fillable=['first_name','last_name','user_id','gender','phone'];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function student()
    {
        return $this->hasOne(Student::class);
    }
    public function students()
    {
        return $this->hasMany(Student::class);
    }
    public function tutors()
    {
        return $this->hasMany(Tutor::class);
    }
    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }
}
