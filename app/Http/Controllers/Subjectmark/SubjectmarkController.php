<?php

namespace App\Http\Controllers\Subjectmark;

use App\AcademicYear;
use App\Http\Controllers\Controller;
use App\Marksheet;
use App\Schoolclass;
use App\Student;
use App\Subject;
use App\SubjectMark;
use App\TerminalExam;
use Illuminate\Http\Request;
use Session;

class SubjectmarkController extends Controller
{
    //function to view all the
    public function mark(Request $request)
    {
        //get class from request id
        $class = Schoolclass::find($request->class_id);

        //get method
        $method = $request->method;

        // getting terminalexam from request
        $terminal = TerminalExam::find($request->terminal_id);
        // dd($terminal->id);
        //getting academicyear from request
        $year = AcademicYear::find($request->year_id);
        if (!$class || !$year || !$terminal)
        {
            return back();
        }

        //get all the subjects of class
        $subjects = $class->subjects;

        if ($subjects->isEmpty())
        {
            Session::flash('nope', 'Add Subject First');
            return redirect()->route('subject.create');
        }
        //getting students from class
        $students = $class->students->where('year_id', $year->id);
        if ($students->isEmpty())
        {
            Session::flash('nope', 'Add Student first');
            return redirect()->route('student.add', ['class_id' => $class->id]);
        }
        // $mark     = $students->last()->subjectmarks->where('terminal_id', $terminal->id);
        // dd($mark->isEmpty());
        $data = [];

        if ($method == 1)
        {
            foreach ($students as $key => $value)
            {
                $mark = $value->subjectmarks->where('terminal_id', $terminal->id);
                if (($mark)->isEmpty())
                {
                    $data[] = $value;
                }
            }
            // dd($data);
            return view('admin.Marks.bystudents')->with('class', $class)
                ->with('students', $data)
                ->with('terminal', $terminal)
                ->with('method', $method)
                ->with('subjects', $subjects)
                ->with('year', $year);
        }
        else
        {
            //return view with the data
            return view('admin.Marks.eachstudent')->with('class', $class)
                ->with('students', $students)
                ->with('terminal', $terminal)
                ->with('method', $method)
                ->with('year', $year);
        }

    }

    public function select($class_id = null, $year_id = null, $terminal_id = null)
    {
        if ($class_id)
        {
            $students = Schoolclass::find($class_id)->students->where('year_id', $year_id);

        }
        else
        {
            $students = null;
        }
        //get all class and terminal and year
        $classes = Schoolclass::all()->sortBy('name');
        // dd($classes);
        $terminals = TerminalExam::all()->sortBy('term');
        $years     = AcademicYear::all()->sortBy('year');

        //count if classes, terminal and years exist
        if (count($classes) < 1)
        {
            Session::flash('nope', 'Add Class first');
            return redirect()->route('class.create');
        }
        if (count($terminals) < 1)
        {
            Session::flash('nope', 'Add Terminal first');
            return redirect()->route('terminal.create');
        }
        if (count($years) < 1)
        {
            Session::flash('nope', 'Add AcademicYear first');
            return redirect()->route('academicyear.create');
        }
        return view('admin.Marks.index')->with('classes', $classes)
            ->with('terminals', $terminals)
            ->with('years', $years)
            ->with('students', $students)
            ->with('terminal_id', $terminal_id);
    }

    //function to return to view create
    public function create($student_id, $class_id, $terminal_id)
    {
        // dd($method);
        //get class, student, terminal from id
        $class    = Schoolclass::find($class_id);
        $student  = Student::find($student_id);
        $terminal = TerminalExam::find($terminal_id);

        //get all the subjects from the class
        $subjects = $class->subjects;
        $data     = [];
        //if no subject been added
        if ($subjects->isEmpty())
        {
            Session::flash('nope', 'add subject for this class first');
            return back();
        }
        // dd($mark->isEmpty());
        foreach ($subjects as $key => $value)
        {
            $mark = Subjectmark::where('student_id', $student_id)
                ->where('terminal_id', $terminal_id)
                ->where('subject_id', $value->id)
                ->get();
            if ($mark->isEmpty())
            {
                $data[] = $value;
            }

        }
        // dd($data);
        if (empty($data))
        {
            Session::flash('nope', 'All subject mark is added');
            return redirect()->route('mark.index.search');
        }
        // dd($data);

        return view('admin.Marks.eachmark')->with('class', $class)
            ->with('student', $student)
            ->with('subjects', $data)
            ->with('terminal', $terminal);
    }

    //function to store the request
    public function store(Request $request, $student_id, $class_id, $terminal_id)
    {
        // dd($request->all());
        //get all the data from request except token
        $data = $request->except('_token');

        // dd($data);
        if (!$data)
        {
            Session::flash('nope', 'Something went wrong please try again');
            return back();
        }
        //loop through each of the input to check if empty
        foreach ($data as $key => $value)
        {

            $ter_mark = Subjectmark::where('student_id', $student_id)
                ->where('terminal_id', $terminal_id)
                ->where('subject_id', $key)
                ->get();
            if (count($ter_mark) > 0)
            {
                Session::flash('nope', 'You cannot add multiple mark of same student for same terminal');
                return back();
            }
        }

        $year_id = Student::find($student_id)->academicyear->id;
        // dd($year_id);
        //get the mark of student in that terminal
        $ter_mark = Subjectmark::where('student_id', $student_id)
            ->where('terminal_id', $terminal_id)->get();

        //get count of all the subject of the class
        $n_subjects = Schoolclass::find($class_id)->subjects->count();

        //check if the mark of the student of that terminal is already added

        //taking total and mark obtained as zero
        // $total_mark          = 0;
        // $total_mark_obtained = 0;
        // $mark                = 0;

        //looping through each of the data
        foreach ($data as $key => $value)
        {

            // saving subjectmark
            $daa[] = SubjectMark::create([
                'student_id'  => $student_id,
                'subject_id'  => $key,
                'mark'        => $value,
                'terminal_id' => $terminal_id,
            ]);

            //adding total mark and mark obtained to get sum
        }
        $student = Student::find($student_id);
        // $class = Schoolclass::find($class_id);
        $this->markcal($student_id, $terminal_id);

        //return to previous page
        Session::flash('success', 'Marks are added');
        return redirect()->route('class.terminal.select', ['class_id' => $class_id, 'year_id' => $year_id, 'terminal_id' => $terminal_id]);
    }

    public function student($student_id, $terminal_id)
    {
        //find student from id
        $student = Student::find($student_id);
        //get terminal exam from id
        $terminal = TerminalExam::find($terminal_id);
        //get class from the student
        $class = $student->class;

        //get subject from the class
        $subjects = $class->subjects;

        //get mark of student
        $subjectmark = $student->subjectmarks->where('terminal_id', $terminal_id);
        // dd($subjectmark);
        // dd($subjectmark);
        foreach ($subjects as $key => $value)
        {
            if (!$subjectmark->contains('subject_id', $value->id))
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

        foreach ($subjectmark as $key1 => $value1)
        {

            $data[] = ['name' => $value1->subject->name,
                'mark'            => $value1->mark,
                "student_id"      => $value1->student_id,
                "terminal_id"     => $value1->terminal_id,
                'passmarks'       => $value1->subject->passmarks,
                'totalmarks'      => $value1->subject->totalmarks,

            ];

        }

        // dd($data);
        // dd($studentmark);
        // $marks = SubjectMark::where('student_id');
        return view('admin.Marks.showmarkofsubject')->with('student', $student)
            ->with('terminal', $terminal)
            ->with('class', $class)
            ->with('subjectmarks', $data);
    }

    public function subject(Request $request, $terminal_id, $class_id)
    {
        // $ok = $this->calculatemark(1,3);
        // return back();
        // dd('ok');
        $terminal   = TerminalExam::find($terminal_id);
        $data       = $request->except('_token', 'subject_id');
        $subject_id = $request->subject_id;
        // dd($data);
        foreach ($data as $key => $value)
        {
            if (!$value)
            {
                Session::flash('nope', 'Please dont leave any empty box');
                return back();
            }
            $mark = Student::find($key)->subjectmarks->where('subject_id',$subject_id)->where('terminal_id',$terminal->id)->first();
            if ($mark) {
                Session::flash('nope','There was an error please try again');
                return back();
            }
        }

        foreach ($data as $key => $value)
        {
            //saving subjectmark
            $daa[] = SubjectMark::create([
                'student_id'  => $key,
                'subject_id'  => $subject_id,
                'mark'        => $value,
                'terminal_id' => $terminal->id,
            ]);

            $final = $this->markcal($key, $terminal->id);
        }
        Session::flash('success', 'Marks of students are successfully added');
        return redirect()->back();

    }

    public function markcal($student_id, $terminal_id)
    {
        $student             = Student::find($student_id);
        $terminal            = TerminalExam::find($terminal_id);
        $class               = $student->class;
        $subjectmarks        = $student->subjectmarks->where('terminal_id', $terminal_id);
        $total_mark_obtained = 0;
        $total_mark          = 0;
        $subjects            = $student->class->subjects;
        foreach ($subjects as $key => $value)
        {
            $total_mark += $value->totalmarks;
        }
        foreach ($subjectmarks as $key => $value)
        {
            $total_mark_obtained += $value->mark;
        }

        // var_dump($num);
        // implode(glue, pieces)
        $b        = strtok($class->name, implode(',', range('a', 'z')));
        $classnum = preg_replace('/[^0-9]/', '', $b);
        // var_dump($b);
        // $classnum =
        //calculate percentage

        $percentage = ($total_mark_obtained / $total_mark) * 100;

        // if ($classnum <= 8)
        // {
        //     if ($percentage >= 70)
        //     {

        //         $grade  = 'A';
        //         $detail = 'Excellent';
        //         $point  = null;
        //     }
        //     elseif ($percentage < 70 && $percentage >= 40)
        //     {
        //         $grade  = 'B';
        //         $detail = 'Good';
        //         $point  = null;
        //     }
        //     else
        //     {
        //         $grade  = 'C';
        //         $detail = 'Satisfactory';
        //         $point  = null;
        //     }

        // }
        // else
        // {
        //     //check percentage
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
        // }
        

        // return $percentage;
        // dd($terminal);
        // dd($total_mark_obtained);

        //saving marksheet
        $mark = Marksheet::updateOrCreate([
            'student_id' => $student->id, 'terminal_id' => $terminal->id,
        ], [
            'student_id'  => $student->id,
            'percentage'  => $percentage,
            'terminal_id' => $terminal->id,
            'grade'       => $grade,
            'total_mark'  => $total_mark_obtained,
            'details'     => $detail,
            'grade_point' => $point,
        ]);
        return $mark;
    }

    public function calculatemark(Request $request)
    {
        $student      = Student::find($request->student_id);
        $terminal     = TerminalExam::find($request->terminal_id);
        $subjectmarks = $student->subjectmarks->where('terminal_id', $request->terminal_id);
        $mark         = $this->markcal($student->id, $terminal->id);
        return $mark;

    }

    public function filtersubject(Request $request)
    {
        // get all the class
        $class = Schoolclass::find($request->class_id);

        //get students of the class
        $students = $class->students->where('year_id', $request->year_id);
        $data     = [];
        // loop through the students and get students whose marks are not added in that subject
        foreach ($students as $key => $value)
        {
            $mark = $value->subjectmarks->where('terminal_id', $request->terminal_id)
                ->where('subject_id', $request->subject_id);
            if (($mark)->isEmpty())
            {
                $data[] = $value;
            }

        }
        $totalmark = Subject::find($request->subject_id)->totalmarks;
        //return the data
        $newarr['students']  = $data;
        $newarr['totalmark'] = $totalmark;
        return $newarr;
    }

    public function update(Request $request)
    {
        $year     = AcademicYear::find($request->year_id);
        $class    = Schoolclass::find($request->class_id);
        $terminal = TerminalExam::find($request->terminal_id);
        // $stu = Student::find(1);
        // $mark = $stu->marks->where('terminal_id',$terminal->id);
        // dd($mark);
        foreach ($class->students as $key => $value)
        {
            $subjectmarks        = $value->subjectmarks->where('terminal_id', $terminal->id);
            $total_mark_obtained = 0;
            $total_mark          = 0;
            $subjects            = $value->class->subjects;
            foreach ($subjects as $key => $value)
            {
                $total_mark += $value->totalmarks;
            }
            foreach ($subjectmarks as $key => $value)
            {
                $total_mark_obtained += $value->mark;
            }
            $this->markcal($value->id, $termina->id);

        }
        return 'ok';
    }

    public function edit($student_id, $terminal_id)
    {
        $student = Student::find($student_id);
        $class   = $student->class;
        // $student  = Student::find($student_id);
        $terminal = TerminalExam::find($terminal_id);

        //get all the subjects from the class
        $subjects = $class->subjects;
        $data     = [];
        // dd($mark->isEmpty());
        //if no subject been added
        if ($subjects->isEmpty())
        {
            Session::flash('nope', 'add subject for this class first');
            return back();
        }
        foreach ($subjects as $key => $value)
        {
            $mark = Subjectmark::where('student_id', $student_id)
                ->where('terminal_id', $terminal_id)
                ->where('subject_id', $value->id)
                ->first();
            if ($mark)
            {
                $data[] = [
                    'subject' => $value,
                    'mark'    => $mark,
                ];
            }

        }
        // dd($data);
        if (empty($data))
        {
            Session::flash('nope', 'No marks are added');
            return back();
        }
        // dd($data);

        return view('admin.Marks.edit')->with('class', $class)
            ->with('student', $student)
            ->with('marks', $data)
            ->with('terminal', $terminal);
        // return view('admin.Marks.edit');

    }

    public function markupdate(Request $request, $student_id, $terminal_id)
    {
        $student  = Student::find($student_id);
        $terminal = TerminalExam::find($terminal_id);
        $data     = $request->except('_token');
        foreach ($data as $key => $value)
        {
            Subjectmark::updateOrCreate(['student_id' => $student_id, 'terminal_id' => $terminal_id, 'subject_id' => $key], ['mark' => $value]);
        }
        // dd($data);
        $this->markcal($student_id, $terminal_id);
        Session::flash('success', 'Marks are successfully updated');
        return redirect()->route('student.subject.mark', ['student_id' => $student_id, 'terminal_id' => $terminal_id]);
    }
}
