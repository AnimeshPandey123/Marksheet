<?php

namespace App;

use App\Student;
use App\Subject;
use Illuminate\Database\Eloquent\Model;

class SubjectMark extends Model
{
    protected $fillable = ['student_id','subject_id','mark','terminal_id'];

    public function student()
    {
    	return $this->belongsTo(Student::class);
    }

    public function subject()
    {
    	return $this->belongsTo(Subject::class);
    }

    public function terminal()
    {
    	return $this->belongsTo(TerminalExam::class);
    }
 
}
