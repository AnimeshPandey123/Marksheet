@extends('layouts.new')

@section('content')
@include('admin.includes.error')
<!--banner-->	
<div class="banner">
				<h2>
				<a href="#">Home</a>
				<i class="fa fa-angle-right"></i>
				<span>Add Terminal</span>
				</h2>
</div>
<!--//banner-->
<div class="content-top">

	<div class="grid-1">
		<h1 id="forms-example">Add Terminal</h1>
			<div class="grid-form1">
			<form class="form-horizontal" action="{{route('terminal.store')}}" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
		
					<div class="form-group">
					<label class="col-sm-2 control-label hor-form">Name of Terminal:</label>
						<div class="col-sm-10">
						<input type="text" name="term" value="{{ old('term') }}" class="form-control" placeholder="Enter Terminal like First or Second">
						</div>
					</div>

					<div class="text-center">
							<button class="btn btn-success" type="submit" >
								<i class="fa fa-upload"></i>
								Add Now
							</button>

					</div>

					

			</form>
		</div>
				

	</div>
	</div>
	
@stop
@section('styles')


@stop