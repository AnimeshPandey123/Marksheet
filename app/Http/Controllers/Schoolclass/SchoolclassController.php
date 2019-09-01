<?php

namespace App\Http\Controllers\Schoolclass;

use App\Http\Controllers\Controller;
use App\Schoolclass;
use App\TerminalExam;
use Illuminate\Http\Request;
use Session;

class SchoolclassController extends Controller
{
    public function index()
    {
        //get all the classes
        $class = Schoolclass::all();
        //return to the view
        return view('admin.class.index')->with('classes', $class);
    }

    //function to redirect to page to create class
    public function create()
    {
        return view('admin.class.create');
    }

    //to store the class
    public function store(Request $request)
    {
        //validate the request
        $this->validate($request, [
            'name' => 'required|unique:schoolclasses',
        ]);
        if (!$request->class_teacher)
        {
            $request->class_teacher = null;
        }

        try {
            \DB::beginTransaction();
            $class = Schoolclass::create([
                'name'          => $request->name,
                'class_teacher' => $request->class_teacher,
            ]);
            \DB::commit();
            Session::flash('success', 'Class added successfully!');
        }
        catch (Exception $e)
        {
            \DB::rollback();
            Session::flash('error', 'Oops! Error Setting Up Class');
            return back();
        }
        return redirect()->route('class');
        // dd($class);
        // Session::flash('success', 'Your Class is saved');

    }

    public function show($class_id, $terminal_id)
    {
        //find class and terminal with the id's
        $class    = Schoolclass::find($class_id);
        $terminal = TerminalExam::find($terminal_id);

        //get all student of the class
        $students = $class->students;

        //initiate an array
        $arr = [];
        // dd($students->first()->academicyear);
        $i = 0;
        // dd($students->find(4)->marks);

        //looping through all the students
        foreach ($students as $student)
        {
            //get all the mark of student
            $mark = $student->marks->where('terminal_id', $terminal_id)->first();
            // dd($mark);
            $arr[] = [
                'rollno'      => $student->rollno,
                'student_id'  => $student->id,
                'firstname'   => $student->firstname,
                'middlename'  => $student->middlename,
                'lastname'    => $student->lastname,
                'year'        => $student->academicyear->year,
                'percentage'  => ($mark) ? $mark->percentage : null,
                'grade'       => ($mark) ? $mark->grade : null,
                'details'     => ($mark) ? $mark->details : null,
                'grade_point' => ($mark) ? $mark->grade_point : null,
            ];
        }

        //changing array to collection
        $data = collect($arr)->sortByDesc('year');
        $year = null;
        //return the view
        return view('admin.Marks.markclass')->with("datas", $data)
            ->with('class', $class)
            ->with('terminal', $terminal)
            ->with('year',$year);
    }

    public function terminal($id)
    {
        //getting class from the id
        $class = Schoolclass::find($id);
        //getting terminal exam
        $terminal = TerminalExam::all();
        //return view
        return view('admin.class.terminal')->with('terminals', $terminal)
            ->with('class', $class);
    }
}
