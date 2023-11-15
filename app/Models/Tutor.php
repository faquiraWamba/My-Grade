<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    use HasFactory;
    protected $fillable=['person_id','student_id','relation'];

    public function people()
    {
        return $this->belongsTo(Person::class,'person_id');
    }

    public function students()
    {
        return $this->belongsTo(Student::class,'student_id');
    }
}
