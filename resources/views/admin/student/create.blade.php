@extends('layouts.new')

@section('content')
@include('admin.includes.error')
<!--banner-->	
		    <div class="banner">
		   
				<h2>
				<a href="#">Home</a>
				<i class="fa fa-angle-right"></i>
				<span>Add Student</span>
				</h2>
		    </div>
<!--//banner-->
<div class="content-top">
			
			
			<div class="grid-1 ">
				
				<div class="grid-form1">
 		<h3 id="forms-example" class="">Add Student</h3>
 		<form action="{{route('student.store')}}" method="post" enctype="multipart/form-data">
 			{{ csrf_field() }}
 			<div class="form-group">
    <label for="exampleInputEmail1">Roll Number</label>
    <input type="text" class="form-control" name="roll" id="exampleInputEmail1" placeholder="Roll Number" value="{{old('roll')}}" required>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">First Name</label>
    <input type="text" class="form-control" name="firstname" id="exampleInputEmail1" value="{{old('firstname')}}" placeholder="First Name" required>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Middle Name</label>
    <input type="text" class="form-control" name="middlename" value="{{old('middlename')}}" id="exampleInputPassword1" placeholder="Middle Name (Optional)">
  </div>
   <div class="form-group">
   <label for="exampleInputPassword1">Last Name</label>
    <input type="text" class="form-control" name="lastname" value="{{old('lastname')}}" id="exampleInputPassword1" placeholder="Last Name" required>
  </div>
  <div class="form-group">
  	<label>Academic Year</label>
  	<select name="year_id" id="year" class="form-control">
							@foreach($years as $year)
								<option selected disabled hidden>Choose Year</option>
								<option value="{{ $year->id }}">{{ $year->year }}</option>
							@endforeach
						</select>
  </div>
  <div class="form-group">
						 <label for="exampleInputPassword1">Select Class</label>
						<select name="class_id" id="class" class="form-control">
							@foreach($classes as $class)
								<option selected disabled hidden>Choose Class</option>
								<option value="{{ $class->id }}">{{ $class->name }}</option>
							@endforeach
						</select>
					</div>

  <button type="submit" class="btn btn-default">Submit</button>
</form>
</div>
			</div>
		
		</div>
	

@stop
@section('styles')


@stop
