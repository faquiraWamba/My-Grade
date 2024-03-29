<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    use HasFactory;
    protected $fillable=['acronym','description'];

    public function classes()
    {
        return $this->hasMany(Classe::class);
    }
}
