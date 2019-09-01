<?php

namespace App\Http\Controllers;

use App\School;
use App\Student;
use App\Schoolclass;
use App\AcademicYear;
use App\TerminalExam;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function dash()
    {
        $school = School::first();
        $students = Student::count();
        // dd($students);
        $class = Schoolclass::count();
        // dd($class);
        $terminal = TerminalExam::count();

        $years = AcademicYear::count();
        $classes = Schoolclass::all();
        
        return view('home')->with('students',$students)
                            ->with('class',$class)
                            ->with('terminal',$terminal)
                            ->with('years',$years)
                            ->with('school',$school);
    }
}
