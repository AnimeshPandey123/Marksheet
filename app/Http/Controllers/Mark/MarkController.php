<?php

namespace App\Http\Controllers\Mark;

use App\AcademicYear;
use App\Http\Controllers\Controller;
use App\Marksheet;
use App\School;
use App\Schoolclass;
use App\Student;
use App\Subject;
use App\TerminalExam;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Session;

class MarkController extends Controller
{
    //function to get all the classes, terminals and years
    public function index()
    {
        $classes   = Schoolclass::all();
        $terminals = TerminalExam::all();
        $years     = AcademicYear::all()->sortBy('year');
        return view('admin.Marks.view')->with('classes', $classes)
            ->with('terminals', $terminals)
            ->with('years', $years);
    }

    //search the students with terminal, class and mark
    public function search(Request $request)
    {
        $this->validate($request, [
            'class_id'    => 'required',
            'year_id'     => 'required',
            'terminal_id' => 'required',
        ]);
        $class    = Schoolclass::find($request->class_id);
        $terminal = TerminalExam::find($request->terminal_id);
        $year     = AcademicYear::find($request->year_id);
        
        if (!$class || !$year || !$terminal)
        {
            return back();
        }
        //get all student of the class
        $students = $class->students->where('year_id', $year->id);
        // dd($students);
        if ($students->isEmpty())
        {
            Session::flash('nope', 'Add students first please');
            return redirect()->route('student.add', ['class_id' => $class->id]);
        }

        //check if subjects are added already
        $subjects = $class->subjects;

        if ($subjects->isEmpty())
        {
            Session::flash('nope', 'Add Subject First');
            return redirect()->route('subject.create');
        }
        //initiate an array
        $arr = [];
        // dd($students->first()->academicyear);
        $i = 0;
        // dd($students->find(4)->marks);

        //looping through all the students
        foreach ($students as $student)
        {
            //get all the mark of student
            $mark = $student->marks->where('terminal_id', $terminal->id)->first();
            // dd($mark);
            if ($mark)
            {
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

        }

        //changing array to collection
        $data = collect($arr)->sortByDesc('year');

        //return the view
        return view('admin.Marks.show')->with("datas", $data)
            ->with('class', $class)
            ->with('terminal', $terminal)
            ->with('year', $year);
    }

    //return page with the student of the mark
    public function create()
    {
        //get all students, subjects and terminals
        $students  = Student::all();
        $subjects  = Subject::all();
        $terminals = TerminalExam::all();

        //check if all of them are already created
        if (count($students) > 0 && count($subjects) > 0 && count($terminals) > 0)
        {
            // dd($subjects);
            return view('admin.Marks.create')->with('students', $students)
                ->with('subjects', $subjects)
                ->with('terminals', $terminals);
        }
        else
        {
            Session::flash('nope', 'Add Subject, Student and TerminalExam');
            return back();
        }

    }

    //store the mark of the student
    public function store(Request $request)
    {
        //validate the request

        $this->validate($request, [
            'student_id'  => 'required',
            'percentage'  => 'required',
            'terminal_id' => 'required',
        ]);
        $percentage = $request->percentage;

        if ($percentage >= 90)
        {
            $grade  = 'A+';
            $detail = 'Outstanding';
            $point  = '4.0';
        }
        elseif ($percentage < 90 && $percentage >= 80)
        {
            $grade  = 'A';
            $detail = 'Excellent';
            $point  = '3.6';
        }
        elseif ($percentage < 80 && $percentage >= 70)
        {
            $grade  = 'B+';
            $detail = 'Very Good';
            $point  = '3.2';
        }
        elseif ($percentage < 70 && $percentage >= 60)
        {
            $grade  = 'B';
            $detail = 'Good';
            $point  = '2.8';
        }
        elseif ($percentage < 60 && $percentage >= 50)
        {
            $grade  = 'C+';
            $detail = 'Satisfactory';
            $point  = '2.4';
        }
        elseif ($percentage < 50 && $percentage >= 40)
        {
            $grade  = 'C';
            $detail = 'Acceptable';
            $point  = '2.0';
        }
        elseif ($percentage < 40 && $percentage >= 30)
        {
            $grade  = 'D+';
            $detail = 'Partially Acceptable';
            $point  = '1.6';
        }
        elseif ($percentage < 30 && $percentage >= 20)
        {
            $grade  = 'D';
            $detail = 'Insufficient';
            $point  = '1.2';
        }
        else
        {
            $grade  = 'E';
            $detail = 'Very Insufficient';
            $point  = '0.8';
        }
        // dd($grade);

        //create marksheet
        $mark = Marksheet::create([
            'student_id'  => $request->student_id,
            'percentage'  => $request->percentage,
            'terminal_id' => $request->terminal_id,
            'grade'       => $grade,
            'details'     => $detail,
            'grade_point' => $point,
        ]);
        // dd($mark);
        Session::flash('success', 'Marks are saved');
        return back();
    }

    //for pdf of marksheet
    public function marksheet($student_id, $terminal_id)
    {
        $student      = Student::find($student_id);
        $terminal     = TerminalExam::find($terminal_id);
        $subjectmarks = $student->subjectmarks->where('terminal_id', $terminal_id);
        $class        = $student->class;
        //get all the mark of student
        $mark  = $student->marks->where('terminal_id', $terminal_id)->first();
        $today = Carbon::today()->format('d/m/Y');
        // dd($today);
        //return the view
        // dd($mark);
        $total = 0;
        $pass  = 0;

        foreach ($class->subjects as $key => $value)
        {
            $total += $value->totalmarks;
            $pass += $value->passmarks;
            if (!$subjectmarks->contains('subject_id', $value->id))
            {
                $data[] = ['name' => $value->name,
                    'mark'            => null,
                    "student_id"      => null,
                    "terminal_id"     => null,
                    'passmarks'       => $value->passmarks,
                    'totalmarks'      => $value->totalmarks,

                ];
            }
        }

        foreach ($subjectmarks as $key1 => $value1)
        {

            $data[] = ['name' => $value1->subject->name,
                'mark'            => $value1->mark,
                "student_id"      => $value1->student_id,
                "terminal_id"     => $value1->terminal_id,
                'passmarks'       => $value1->subject->passmarks,
                'totalmarks'      => $value1->subject->totalmarks,

            ];

        }
        $school = School::first();
        if ($school)
        {
            $url = Storage::disk('local')->url('public/' . $school->logo);
        }
        else
        {
            $url = '';
        }
        $html = '<img src="' . asset($school->logo) . ' " style="width: 100px; height:100px;">';
        // dd($url);
        // $html = '<img src="'.base_path().' '.$url.' " width="42" height="42">';
        // return $html;
        $pdf = App::make('dompdf.wrapper');
        // $dompdf = new Dompdf();
        $pdf->loadHTML($html);
        return $pdf->stream();

        // return view('admin.Marks.testmarksheet')->with('terminal',$terminal)
        //                                     ->with('student',$student)
        //                                     ->with('mark',$mark)
        //                                     ->with('subjectmarks',$subjectmarks)
        //                                     ->with('total',$total)
        //                                     ->with('class',$class)
        //                                     ->with('school',$school)
        //                                     ->with('pass',$pass)
        //                                     ->with('today',$today)
        //                                     ->with('url',$url);

        // $pdf->set_base_path(asset('css/bootstrap.min.css'));
        // <link href="{{asset('css/bootstrap.min.css')}}" rel='stylesheet' type='text/css' />
        $pdf->loadView('admin.Marks.testmarksheet', ['terminal' => $terminal, 'student' => $student, 'class' => $class, 'mark' => $mark, 'subjectmarks' => $data, 'total' => $total, 'today' => $today, 'pass' => $pass, 'school' => $school, 'url' => asset($url)]);
        // $pdf->setPaper('A4', 'landscape');
        return $pdf->stream();
    }

    public function marksheetclass($class_id, $terminal_id, $year_id)
    {
        // $student      = Student::find($student_id);
        $class    = Schoolclass::find($class_id);
        $students = $class->students->where('year_id', $year_id);
        $terminal = TerminalExam::find($terminal_id);
        $i        = 0;
        if ($students->isEmpty())
        {
            Session::flash('nope', 'Add students first');
            return redirect()->route('student.add', ['class_id' => $class->id]);
        }
        foreach ($students as $key => $student)
        {
            $i            = $i + 1;
            $subjectmarks = $student->subjectmarks->where('terminal_id', $terminal_id);
            if ($subjectmarks->isEmpty())
            {
                Session::flash('nope', 'Add marks of all the student first');
                return redirect()->route('class.terminal.select');
            }
            $class = $student->class;
            //get all the mark of student
            $mark  = $student->marks->where('terminal_id', $terminal_id)->first();
            $today = Carbon::today()->format('d/m/Y');
            // dd($today);
            //return the view
            // dd($mark);
            $total = 0;
            $pass  = 0;

            foreach ($class->subjects as $key => $value)
            {
                $total += $value->totalmarks;
                $pass += $value->passmarks;
                if (!$subjectmarks->contains('subject_id', $value->id))
                {
                    $varname    = "data" . $i;
                    $$varname[] = ['name' => $value->name,
                        'mark'                => null,
                        "student_id"          => null,
                        "terminal_id"         => null,
                        'passmarks'           => $value->passmarks,
                        'totalmarks'          => $value->totalmarks,

                    ];
                }
            }

            foreach ($subjectmarks as $key1 => $value1)
            {
                $varname    = "data" . $i;
                $$varname[] = [
                    'name'        => $value1->subject->name,
                    'mark'        => $value1->mark,
                    "student_id"  => $value1->student_id,
                    "terminal_id" => $value1->terminal_id,
                    'passmarks'   => $value1->subject->passmarks,
                    'totalmarks'  => $value1->subject->totalmarks,

                ];

            }
            $datastu[] = [
                'student' => $student,
                'mark'    => $$varname,
                'final'   => $mark,

            ];
        }

        $school = School::first();
        // dd($datastu);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('admin.Marks.classmarksheet', ['terminal' => $terminal, 'students' => $datastu, 'class' => $class, 'total' => $total, 'today' => $today, 'pass' => $pass, 'school' => $school]);

        return $pdf->stream();

    }

}
