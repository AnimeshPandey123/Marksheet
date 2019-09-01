<?php

namespace App\Http\Controllers\Terminal;

use Session;
use App\TerminalExam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TerminalController extends Controller
{
    //function to return to page to create
    public function create()
    {
    	return view('admin.Terminal.create');
    }

    //function to return to view all terminal
    public function index()
    {
        //get all terminals
        $terminals = TerminalExam::all();
        //return view 
        return view('admin.Terminal.index')->with('terminals',$terminals);
    }

    public function store(Request $request)
    {
        //validate request
    	$this->validate($request, [
            'term'       => 'required|unique:terminal_exams'
        ]);

        //create terminal
         // dd($request->year);
        try {
            \DB::beginTransaction();
            $term = TerminalExam::create([
                'term' => $request->term,
            ]);
            \DB::commit();
            Session::flash('success', 'Terminal successfully!');
        }
        catch (\Exception $e)
        {
            \DB::rollback();
            Session::flash('error', 'Oops! Error Setting Up Terminal exam');
        }
        
        return back();
    }
}
