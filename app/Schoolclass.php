<?php

namespace App;

use App\Student;
use Illuminate\Database\Eloquent\Model;

class Schoolclass extends Model
{
    protected $fillable = ['name','class_teacher'];

    public function students()
    {
    	return $this->hasMany(Student::class,'class_id');
    }

    public function subjects()
    {
    	return $this->hasMany(Subject::class,'class_id');
    }
    
}
