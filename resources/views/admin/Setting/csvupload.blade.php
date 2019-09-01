@extends('layouts.new')
@section('content')
<!--banner-->	
		    <div class="banner">
		   
				<h2>
				<a href="#">Home</a>
				<i class="fa fa-angle-right"></i>
				<span>Upload CSV</span>
				</h2>
		    </div>
<!--//banner-->
<div class="content-top">
			
			
			<div class="grid-1 ">
 				<h3>Upload CSV of students for class {{$class->name}} of {{$year->year}} year</h3>
        
 			<br>
<div class="form-horizontal">
  

  <form class="form-horizontal" action="{{route('csv',['class_id'=>$class->id,'year_id'=>$year->id])}}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}

  
  <div class="form-group">
  <label class="col-sm-2 control-label hor-form">Upload CSV:</label>
   <div class="col-sm-10">
      <input type="file" class="form-control" id="inputEmail3" name="file" accept=".csv">
    </div>
</div>
    <div class="form-group" >
    <div class="col-sm-offset-2 col-sm-10">
      <button class="btn btn-info" type="submit"><i class="fa fa-upload"></i> Save</button>
    </div>
    
</div>
    </div>
    </form>
    <br>
  <div>
    <span class="label label-primary">The CSV must be in following format otherwise it won't work.</span> 
    <br>
    <br>
    <a class="btn btn-success" href="{{asset('format.csv')}}" download><i class="fa fa-download"></i> Download CSV</a>
    <br>
    <br><br>
    <img src="{{asset('img/csv.png')}}" width="40%">
  </div>
  </div>
  </div>
 			

@stop
@section('styles')

@stop

@section('scripts')

@stop
