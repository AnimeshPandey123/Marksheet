@extends('layouts.new')

@section('content')
@include('admin.includes.error')
<!--banner-->	
<div class="banner">
				<h2>
				<a href="#">Home</a>
				<i class="fa fa-angle-right"></i>
				<span>Add Mark</span>
				</h2>
</div>
<!--//banner-->
	
		<div class="content-top">
			
			
			<div class="grid-1 ">
			<form action="{{route('mark.store')}}" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}

					<div class="form-group">
						<strong>Student Name</strong>
						<br>
						<select name="student_id" id="class" class="form-control boxe"> 
							@foreach($students as $student)
								<option value="{{ $student->id }}">{{ $student->firstname }} {{$student->lastname}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<strong>Terminal </strong>
						<select name="terminal_id" id="" class="form-control boxe"> 
							@foreach($terminals as $terminal)
								<option value="{{ $terminal->id }}">{{ $terminal->term }} </option>
							@endforeach
						</select>
					</div>
					

					<div class="form-group">
						<strong>Total Percentage</strong>
						<input type="text" name="percentage" value="{{ old('percentage') }}" class="form-control boxe" placeholder="Enter total percentage obtained" required>
					</div>

					<div class="text-center">
							<button class="btn btn-success" type="submit" >
								<i class="fa fa-upload"></i>
								Post Now
							</button>

					</div>

					

			</form>
				
		</div>



	</div>
	
@stop
@section('styles')


@stop