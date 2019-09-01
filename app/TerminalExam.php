<?php

namespace App;

use App\Student;
use App\Marksheet;
use App\SubjectMark;
use Illuminate\Database\Eloquent\Model;

class TerminalExam extends Model
{
    protected $fillable = ['term'];

    public function marks()
    {
    	return $this->hasMany(Marksheet::class,'terminal_id');
    }

    public function subjectmarks()
    {
    	return $this->hasMany(SubjectMark::class);
    }
}
