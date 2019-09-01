@extends('layouts.new')

@section('content')
@include('admin.includes.error')
	<!--banner-->	
		    <div class="banner">
		   
				<h2>
				<a href="#">Home</a>
				<i class="fa fa-angle-right"></i>
				<span>Add Class</span>
				</h2>
		    </div>
<!--//banner-->
<div class="content-top">
			
			
			<div class="grid-1 ">

	<div class="grid-form1">
<h3 id="forms-horizontal">Create Class</h3>
<form class="form-horizontal" action="{{route('class.store')}}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label hor-form">Class</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputEmail3" placeholder="Enter Class Name" name="name">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label hor-form">Class Teacher</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputPassword3" placeholder="Enter Class Teacher Name (Optional)" name="class_teacher">
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Save</button>
    </div>
  </div>
</form>
</div>
</div>
</div>
	
@stop
@section('styles')


@stop
