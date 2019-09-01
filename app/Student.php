<?php

namespace App;

use App\Subject;
use App\Marksheet;
use App\SubjectMark;
use App\AcademicYear;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['firstname','middlename','lastname','class_id','year_id','rollno']; 

    public function class()
    {
    	return $this->belongsTo(Schoolclass::class,'class_id');
    }

    public function subject()
    {
    	return $this->hasManyThrough(Subject::class, Schoolclass::class);
    	// return $this->hasMany(Subject::class,'student_id');
    }

    public function marks()
    {
    	return $this->hasMany(Marksheet::class);
    }

    public function subjectmarks()
    {
        return $this->hasMany(SubjectMark::class,'student_id');
    }

    public function academicyear()
    {
        return $this->belongsTo(AcademicYear::class,'year_id');
    }
}
