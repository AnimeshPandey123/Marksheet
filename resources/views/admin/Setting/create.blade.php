@extends('layouts.new')
@section('content')
<!--banner-->	
		    <div class="banner">
		   
				<h2>
				<a href="#">Home</a>
				<i class="fa fa-angle-right"></i>
				<span>Create Setting</span>
				</h2>
		    </div>
<!--//banner-->
<div class="content-top">
			
			
			<div class="grid-1 ">
 				<h3>Update School Info</h3>
        
 			<br>
<div class="form-horizontal">
  

  <form class="form-horizontal" action="{{route('store.setting')}}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label hor-form">Name:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputEmail3" placeholder="Enter School Name" name="name" required autocomplete="off">
    </div>
  </div>
  <div class="form-group">
  <label class="col-sm-2 control-label hor-form">Upload Logo:</label>
   <div class="col-sm-10">
      <input type="file" class="form-control" id="inputEmail3" name="logo" accept=".jpg, .jpeg, .png">
    </div>
</div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label hor-form">Location:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputPassword3" placeholder="Enter location" name="location" autocomplete="off">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label hor-form">Email:</label>
    <div class="col-sm-10">
       <input type="email" class="form-control" id="inputPassword3" placeholder="Enter email of school (Optional)" name="email">
</div>
    </div>
    <div class="form-group" >
    <div class="col-sm-offset-2 col-sm-10">
      <button class="btn btn-info" type="submit">Save</button>
    </div>
    
</div>
    </div>
    </form>
  </div>
  
</div>
</div>
 			

@stop
@section('styles')

@stop

@section('scripts')

@stop
