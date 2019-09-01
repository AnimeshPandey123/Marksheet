@extends('layouts.new')

@section('content')
@include('admin.includes.error')
<!--banner-->	
<div class="banner">
				<h2>
				<a href="#">Home</a>
				<i class="fa fa-angle-right"></i>
				<span>Add Academic Year</span>
				</h2>
</div>
<!--//banner-->
<div class="content-top">

	<div class="grid-1">
		
			<div class="grid-form1">
				<div style="margin:10px;">
			
				<div class="text-center">
				<form method="POST" action="{{ route('academicyear.store') }}">
					{{ csrf_field() }}
					<h3 class="text-info">
						<i class="fa fa-plus"></i>&nbsp;
						Add Academic Year
					</h3><br>
					<input type="number" name="year" class="form-control col-md-4" placeholder="Type the Year" style="margin-left:auto;margin-right:auto;" min="1999" max="2200" required autocomplete="off">
					<br>
					<br>
					<button class="btn btn-success" type="submit">
						<i class="fa fa-plus"></i>&nbsp;
						Add
					</button>
				</form>
			</div>
		
	</div>	
		</div>
				

	</div>
	</div>
	
@stop
@section('styles')


@stop