<?php

namespace App;

use App\Schoolclass;
use App\SubjectMark;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name','class_id','totalmarks','passmarks'];

    public function subjectmarks()
    {
    	return $this->hasMany(SubjectMark::class);
    }

    public function sclass()
    {
    	return $this->belongsTo(Schoolclass::class,'class_id');
    }
}
