@extends('layouts.new')

@section('content')
@include('admin.includes.error')
	<!--banner-->	
<div class="banner">
				<h2>
				<a href="#">Home</a>
				<i class="fa fa-angle-right"></i>
				<span>Search Class</span>
				</h2>
</div>
<!--//banner-->
	
		<div class="content-top">
			
			
			<div class="grid-1 ">
			<div class="grid-form1">
			<h3 id="forms-example" class="text-center">Select Class</h3>
			<form action="{{route('csv.class.search')}}" method="get" enctype="multipart/form-data">
				

					<div class="form-group">
						<strong>Class</strong>
						<br>
						<select name="class_id" id="class" class="form-control boxe" required> 
							@foreach($classes as $class)
								<option selected disabled hidden>Choose Class</option>
								<option value="{{ $class->id }}">{{ $class->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<strong>Academic Year </strong>
						<select name="year_id" id="" class="form-control" required> 
							@foreach($years as $year)
								
								<option value="{{ $year->id }}">{{ $year->year }} </option>
							@endforeach
						</select>
					</div>
					<div class="text-center">
							<button class="btn btn-default" type="submit" >
								<i class="fa fa-search"></i>
								Search
							</button>
					</div>

					

			</form>
			</div>
				
		</div>



	</div>

	
@stop
@section('styles')


@stop