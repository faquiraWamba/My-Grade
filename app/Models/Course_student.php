<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course_student extends Model
{
    use HasFactory;
    protected $fillable=['student_id','classe_id','school_year','report_card'];

    public function class_student()
    {
        return $this->belongsTo(Class_Student::class);
    }
    public function class_course()
    {
        return $this->belongsTo(Class_Course::class);
    }
    public function note()
    {
        return $this->hasMany(Note::class);
    }

    public function getNoteByType($type) {
        foreach ($this->note as $note) {
            if ($note->type == $type) {
                return $note->note;
            }
        }
        return null;
    }
}
