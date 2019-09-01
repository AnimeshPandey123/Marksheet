<?php

namespace App\Http\Controllers\School;

use App\AcademicYear;
use App\Http\Controllers\Controller;
use App\School;
use App\Schoolclass;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Session;
use Response;

class SchoolController extends Controller
{
    public function index()
    {
        $school = School::first();
        // dd($school->logo);
        if ($school)
        {
            $url = Storage::disk('local')->url('public/' . $school->logo);
        }
        else
        {
            $url = '';
        }

        // dd($url);
        // return "<img src = '".asset($url)."'/>";
        // dd($exists);
        return view('admin.Setting.index')->with('school', $school)->with('url', $url);
    }

    public function image($image)
    {
        // return storage_path('public/' . $filename)->response();
        // return Storage::get($filename);
        $file = Storage::get('local')->get($school->logo);
        // dd($contents);
        // return $file;
        // return new Response($file,200);
    }

    public function edit($id)
    {
        $school = School::find($id);
        return view('admin.Setting.edit')->with('school', $school);
    }

    public function create()
    {
        return view('admin.Setting.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'name' => 'required|unique:schools',
        ]);

        if ($request->hasFile('logo'))
        {
            $image = $request->file('logo');

            $image             = $request->file('logo');
            $featured_new_name = '/' . $image->getClientOriginalName();
            $new_name          = 'img/logo' . $featured_new_name;
            $image->storeAs('public/img/logo', $featured_new_name);
            // Storage::disk('local')->put($new_name,File::get($image));
            // $image->move('img/logo',$featured_new_name);

            // Storage::disk('local')->putFile('public/img/logo',File::get($image));
            // $image->move('img/logo',$featured_new_name);
        }
        else
        {
            $new_name = null;
        }

        $school = School::create([
            'name'    => $request->name,
            'address' => $request->location,
            'logo'    => $new_name,
            'email'   => $request->email,
        ]);

        Session::flash('success', 'Your school info is saved');
        return redirect()->route('settings');

    }

    public function update(Request $request, $school_id)
    {
        // dd($request->all());

        $school = School::find($school_id);
        // dd($school);
        $this->validate($request, [
            'name' => 'required',
        ]);

        if ($request->hasFile('logo'))
        {
            if (Storage::disk('local')->exists('public/' . $school->logo))
            {

                // this one will also check if it actually has an extension
                $parts = explode(".", $school->logo);
                if (is_array($parts) && count($parts) > 1)
                {
                    $extension = end($parts);
                    Storage::delete('public/' . $school->logo);
                }
                // dd($extension);

            }

            $image             = $request->file('logo');
            $featured_new_name = '/' . $image->getClientOriginalName();
            $new_name          = 'img/logo' . $featured_new_name;
            $image->storeAs('public/img/logo', $featured_new_name);
            // Storage::disk('local')->put($new_name,File::get($image));
            // $image->move('img/logo',$featured_new_name);
            // dd($new_name);
            $school->logo = $new_name;
        }

        if ($request->name)
        {
            $school->name = $request->name;
        }
        $school->email   = $request->email;
        $school->address = $request->location;
        $school->save();

        Session::flash('success', 'Your school info is saved');
        return redirect()->route('settings');

    }

    public function csv()
    {
        $class = Schoolclass::all();
        $year  = AcademicYear::all();
        return view('admin.Setting.csvsearch')->with('classes', $class)
            ->with('years', $year);
    }

    public function search(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'class_id'    => 'required',
            'year_id'     => 'required'
        ]);
        $class = Schoolclass::find($request->class_id);
        $year  = AcademicYear::find($request->year_id);
        return view('admin.Setting.csvupload')->with('class', $class)
            ->with('year', $year);
    }

    public function csvupload(Request $request, $class_id, $year_id)
    {

        $class = Schoolclass::find($class_id);
        $year  = AcademicYear::find($year_id);

        $file = fopen($request->file('file'), 'r');
        while ($row = fgetcsv($file))
        {
            if (implode($row))
            {
                $data[] = $row;
            }

        }
        $header = $data[0];
        unset($data[0]);
        // dd($header);
        for ($i = 0; $i < count($header); $i++)
        {
            if ($header[$i] == 'firstname')
            {
                $first_index = $i;
            }
            elseif ($header[$i] == 'lastname')
            {
                $last_index = $i;
            }
            elseif ($header[$i] == 'rollno')
            {
                $roll_index = $i;
            }
            elseif ($header[$i] == 'middlename')
            {
                $middle_index = $i;
            }

        }
        if (!$first_index && !$last_index && !$roll_index)
        {
             Session::flash('nope', 'The spelling of the header is mistake. Please use the correct one');
            return back();
        }
        
        // dd($roll_index);
        try {
            foreach ($data as $row)
            {
                if ($row[$first_index] == '' || $row[$last_index] == '' || $row[$roll_index] == '')
                {
                    Session::flash('nope', 'First & last name and roll no cannot be null');
                    return back();
                }
                Student::create([
                    'firstname'  => $row[$first_index],
                    'middlename' => $row[$middle_index],
                    'lastname'   => $row[$last_index],
                    'rollno'     => $row[$roll_index],
                    'class_id'   => $class->id,
                    'year_id'    => $year->id,
                ]);
            }

        }
        catch (Exception $e)
        {
            Session::flash('nope', 'Something went wrong');
            return back();
        }

        // dd($data);
        Session::flash('success', 'Students data succesfully stored');
        return back();

    }

}
