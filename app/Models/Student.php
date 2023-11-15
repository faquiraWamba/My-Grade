<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;

class Student extends Model
{
    use HasFactory;
    protected $fillable=['registration_number','birthday','picture','person_id','birth_town'];

    public function getPictureAttribute($val):string{
        if($val==null){
            return env('APP_URL').'/default.png';
        }
        return Storage::disk('public')->url($val);
    }
    public function people()
    {
        return $this->belongsTo(Person::class,'person_id');
    }
    public function class_students()
    {
        return $this->hasMany(Class_Student::class);
    }
    public function tutors()
    {
        return $this->hasMany(Tutor::class);
    }
    
   
}
