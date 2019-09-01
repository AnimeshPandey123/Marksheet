<?php

namespace App\Http\Controllers\Subject;

use App\Http\Controllers\Controller;
use App\Schoolclass;
use App\Subject;
use Illuminate\Http\Request;
use Session;

class SubjectController extends Controller
{
    //function to return to view with all the subjects
    public function index()
    {
        //get all the subject
        $subjects = Subject::all();
        $classes  = Schoolclass::all();
        // dd($subjects->first()->sclass);
        return view('admin.Subject.index')->with('subjects', $subjects)
            ->with('classes', $classes);
    }

    public function create()
    {
        //get class of the student
        $class = Schoolclass::all();

        //check if any class exist
        if (count($class) < 1)
        {
            Session::flash('nope', 'Add Class First');
            return redirect()->route('class.create');
        }

        return view('admin.Subject.create')->with('classes', $class);
    }

    public function store(Request $request)
    {
        //get all the request
        $data = $request->except('_token', 'class_id');
        // dd(empty($data['subject1']));

        //check for any empty inputs
        foreach ($data as $key => $value)
        {
            if (empty($value['name']))
            {
                Session::flash('nope', 'Dont send empty inputs');
                return back();
            }
        }
        $class_id = $request->class_id;

        try {
            \DB::beginTransaction();
            // dd($data);
            foreach ($data as $key => $value)
            {
                $subject[] = Subject::create([
                    'name'       => $value['name'],
                    'totalmarks' => $value['totalmark'],
                    'passmarks' => $value['passmark'],
                    'class_id'   => $class_id,
                ]);
            }
            \DB::commit();
            Session::flash('success', 'Subjects added successfully!');
        }
        catch (\Exception $e)
        {
            \DB::rollback();
            Session::flash('error', 'Oops! Error Adding Subjects');
        }
        //saving each subject

        // Session::flash('success','Your Subject is saved');
        return back();
    }

    //filter subject with class
    public function filtersubject(Request $request)
    {
        $class = Schoolclass::find($request->class_id);
        $subjects = $class->subjects;
        return $subjects;
    }
}
