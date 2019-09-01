<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marksheet extends Model
{
    protected $fillable = ['student_id','total_mark','percentage','grade','details','grade_point','terminal_id'];

    public function student()
    {
    	return $this->belongsTo('App\Student');
    }
}
