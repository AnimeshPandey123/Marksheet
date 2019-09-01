<?php

namespace App\Http\Controllers\Student;

use App\AcademicYear;
use App\Http\Controllers\Controller;
use App\Schoolclass;
use App\Student;
use Illuminate\Http\Request;
use Session;

class StudentController extends Controller
{
    public function index($class_id)
    {
        $class = Schoolclass::find($class_id);
        $year  = AcademicYear::all();
        if ($year->isEmpty())
        {
            Session::flash('nope', 'Add AcademicYear first');
            return redirect()->route('academicyear.create');
        }
        return view('admin.student.add')->with('class', $class)
            ->with('years', $year);
    }

    public function view($class_id)
    {
        $class    = Schoolclass::find($class_id);
        $years    = AcademicYear::all();
        $students = $class->students;
        return view('admin.student.view')->with('students', $students)
            ->with('class', $class)
            ->with('years', $years);
    }

    //fucntion to direct to page to create student
    public function create()
    {
        //get all the class and academic year
        $class = Schoolclass::all();
        $year  = AcademicYear::all();

        //check if academic year and class is created or nut
        if (count($year) < 1)
        {
            Session::flash('nope', 'Create AcademicYear first');
            return redirect()->route('academicyear.create');
        }
        if (count($class) == 0)
        {
            Session::flash('nope', 'Create Class first');
            return redirect()->route('class.create');
        }

        //return to view
        return view('admin.student.create')->with('classes', $class)
            ->with('years', $year);
    }

    public function store(Request $request)
    {
        //validation of request
        $this->validate($request, [
            'firstname' => 'required',
            'lastname'  => 'required',
            'class_id'  => 'required',
            'year_id'   => 'required',
            'roll'      => 'required',
        ]);
        // dd($request->all());
        //check if the request has middlename
        if (!$request->middlename)
        {
            $request->middlename = null;
        }
        $student = Student::create([
            'firstname'  => $request->firstname,
            'middlename' => $request->middlename,
            'lastname'   => $request->lastname,
            'class_id'   => $request->class_id,
            'year_id'    => $request->year_id,
            'rollno'     => $request->roll,
        ]);
        Session::flash('success', 'Your Student is added');
        // dd($student);
        return back();
    }

    public function add(Request $request, $class_id)
    {

        //get all the request
        $data = $request->except('_token', 'year_id');
        // dd($data);

        //check for any empty inputs
        foreach ($data as $key => $value)
        {
            if (empty($value['fname'] || $value['lname']))
            {
                Session::flash('nope', 'Dont send empty inputs of firstname and lastname');
                return back();
            }
        }

        $year_id = $request->year_id;
        //saving each subject
        // dd($data);
        try {
            \DB::beginTransaction();
            foreach ($data as $key => $value)
            {
                if (!$value['mname'])
                {
                    $value['mname'] = null;
                }
                $subject[] = Student::create([
                    'rollno'     => $value['roll'],
                    'firstname'  => $value['fname'],
                    'middlename' => $value['mname'],
                    'lastname'   => $value['lname'],
                    'class_id'   => $class_id,
                    'year_id'    => $year_id,
                ]);
            }
            \DB::commit();
            Session::flash('success', 'Students added successfully!');
        }
        catch (\Exception $e)
        {
            \DB::rollback();
            Session::flash('nope', 'Oops! Error Adding Students');
        }

        return back();
    }

    public function getStudent(Request $request)
    {
        $class_id = $request->class_id;
        $year_id  = $request->year_id;
        $year     = AcademicYear::find($year_id);
        $class    = Schoolclass::find($class_id);
        $students = $class->students->where('year_id', $year->id);
        return $students;
    }
}
