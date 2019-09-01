<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function ()
{
    if (Auth::check())
    {
        return redirect()->route('admin');
    }
    else
    {
        return view('auth.login');
    }
})->name('index');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
// Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('register', 'Auth\RegisterController@register');

Route::get('/home', 'HomeController@index')->name('home');
// Route::get('testing',function(){
//     return view('auth.test');
// });
// Route::get('testing/ok',function(){
//     return view('auth.testregister');
// });

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function ()
{
    Route::get('/', 'HomeController@dash')->name('admin');

    Route::get('/class', 'Schoolclass\SchoolclassController@index')->name('class');
    Route::get('/class/create', 'Schoolclass\SchoolclassController@create')->name('class.create');

    Route::post('class/store', 'Schoolclass\SchoolclassController@store')->name('class.store');
    Route::get('student/create', 'Student\StudentController@create')->name('student.create');
    Route::post('student/store', 'Student\StudentController@store')->name('student.store');
    Route::get('add/student/{class_id}', 'Student\StudentController@index')->name('student.add');
    Route::post('add/student/{class_id}', 'Student\StudentController@add')->name('student.add.store');
    Route::get('view/students/{class_id}', 'Student\StudentController@view')->name('student.view');
    //To create subject
    Route::get('subject/create', 'Subject\SubjectController@create')->name('subject.create');

    //To view subjects
    Route::get('subject', 'Subject\SubjectController@index')->name('subject.index');
    //To Store Subject
    Route::post('subject/store', 'Subject\SubjectController@store')->name('subject.store');
    // Route::get('marks/create', 'Mark\MarkController@create')->name('mark.create');
    // Route::post('marks/store', 'Mark\MarkController@store')->name('mark.store');

    //to view marks of students of given class_id and given terminal_id
    Route::get('class/marks/{class_id}/{terminal_id}', 'Schoolclass\SchoolclassController@show')->name('class.marks');

    //to redirect to page to create terminal id
    Route::get('terminal/create', 'Terminal\TerminalController@create')->name('terminal.create');

    //to view all terminal added
    Route::get('terminal', 'Terminal\TerminalController@index')->name('terminal.index');
    //to store terminal in db
    Route::post('terminal/store', 'Terminal\TerminalController@store')->name('terminal.store');

    //To Select terminal in a class to view result
    Route::get('class/terminal/{id}', 'Schoolclass\SchoolclassController@terminal')->name('class.terminal');

    //to redirect to page to select class and terminal
    Route::get('class/select/terminal/search/{class_id?}/{terminal_id?}/{year_id?}', 'Subjectmark\SubjectmarkController@select')->name('class.terminal.select');

    //to store marks of students in class for a terminal
    Route::get('class/terminal/', 'Subjectmark\SubjectmarkController@mark')->name('class.terminal.mark');

    //to redirect to pagae to store data of student of class of terminal
    Route::get('class/terminal/student/{student_id}/{class_id}/{terminal_id}/', 'Subjectmark\SubjectmarkController@create')->name('class.terminal.student.mark');
    Route::post('class/terminal/student/store/{student_id}/{class_id}/{terminal_id}/', 'Subjectmark\SubjectmarkController@store')->name('class.terminal.student.mark.store');

    //get mark of each subject of student
    Route::get('student/subjects/mark/{student_id}/{terminal_id}', 'Subjectmark\SubjectmarkController@student')->name('student.subject.mark');

    Route::get('academicyear/create', 'AcademicYear\AcademicyearController@create')->name('academicyear.create');
    Route::post('academicyear/store', 'AcademicYear\AcademicyearController@store')->name('academicyear.store');

    //for viewing mark
    Route::get('marksheet/{student_id}/{terminal_id}', 'Mark\MarkController@marksheet')->name('marksheet');
     Route::get('class/marksheet/{class_id}/{terminal_id}/{year_id}', 'Mark\MarkController@marksheetclass')->name('marksheet.class');
    Route::get('mark/view', 'Mark\MarkController@index')->name('mark.index');
    Route::get('mark/view/search', 'Mark\MarkController@search')->name('mark.index.search');

    //for ajax query
    Route::get('student/get/', 'Student\StudentController@getStudent'
    )->name('student.get');

    //store mark of each student of certain subject

    Route::post('subject/student/{terminal_id}/{class_id}', 'Subjectmark\SubjectmarkController@subject')->name('class.mark.store');

    //filter subject and marks with student id, terminal id and year id
    Route::get('subject/student/filter', 'Subjectmark\SubjectmarkController@filtersubject')->name('subject.filter');

    //for ajax query to search for subject of specific class
    Route::get('class/subject/get', 'Subject\SubjectController@filtersubject')->name('subject.class');

    //Settings
    Route::get('settings', 'School\SchoolController@index')->name('settings');
    Route::get('settings/edit/{id}', 'School\SchoolController@edit')->name('edit.setting');
    Route::get('settings/create/', 'School\SchoolController@create')->name('create.setting');
    Route::post('settings/store/', 'School\SchoolController@store')->name('store.setting');
    Route::post('settings/update/{id}', 'School\SchoolController@update')->name('update.setting');

    Route::get('getimage/{$image}','School\SchoolController@image')->name('image');

    Route::get('update/mark/','Subjectmark\SubjectmarkController@update')->name('update.mark');

    Route::get('update/mark/each','Subjectmark\SubjectmarkController@calculatemark')->name('update.mark.each');

    Route::get('mark/edit/{student_id}/{terminal_id}','Subjectmark\SubjectmarkController@edit')->name('mark.edit');

    Route::post('mark/update/{student_id}/{terminal_id}','Subjectmark\SubjectmarkController@markupdate')->name('student.mark.update');

    Route::get('csv/search/','School\SchoolController@csv')->name('csv.search');
    Route::get('csv/','School\SchoolController@search')->name('csv.class.search');
    Route::post('csv/{class_id}/{year_id}','School\SchoolController@csvupload')->name('csv');
});
