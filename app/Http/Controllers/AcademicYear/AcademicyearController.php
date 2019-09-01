<?php

namespace App\Http\Controllers\AcademicYear;

use App\AcademicYear;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class AcademicyearController extends Controller
{
    public function create()
    {
        return view('admin.AcademicYear.create');
    }

    public function store(Request $request)
    {
        // VALIDATE Year
        $this->validate($request, [
            'year' => 'required|unique:academic_years|max:2100',
        ]);
        // dd($request->year);
        try {
            \DB::beginTransaction();
            AcademicYear::create([
                'year' => $request->year,
            ]);
            \DB::commit();
            Session::flash('success', 'Academic Year added successfully!');
        }
        catch (\Exception $e)
        {
            \DB::rollback();
            Session::flash('error', 'Oops! Error Setting Up Academic Year');
        }

        return back();

    }
}
