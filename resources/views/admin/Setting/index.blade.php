@extends('layouts.new')
@section('content')
<!--banner-->	
		    <div class="banner">
		   
				<h2>
				<a href="#">Home</a>
				<i class="fa fa-angle-right"></i>
				<span>Setting</span>
				</h2>
		    </div>
<!--//banner-->
<div class="content-top">
			
			
			<div class="grid-1 ">
 				<h3>Setting</h3>
        <div>
        @if($school)
          <a style="float: right;" href="{{route('edit.setting',['id'=>$school->id])}}" class="btn btn-info">Edit</a>
        @else
          <a style="float: right;" href="{{route('create.setting')}}" class="btn btn-info">Create</a>
        @endif
        </div>
 			<br>
    
 	<div class="grid-form1">
  @if($school)
  @if(Storage::disk('local')->exists('public/'.$school->logo))
  <div class="card" style="width:400px;margin: 0 auto;">
    <img id="originalImage" class="card-img-top" src="{{$url}}" alt="Card image" style="width:30%; height: 20%;">
    
    <div class="card-body">
    <br>
      
     
    </div>
  </div>
  @endif
  

<div class="form-horizontal">
  

  <br>

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label hor-form">Name:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputEmail3" value="{{$school->name}}" name="name" readonly>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label hor-form">Location:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputPassword3" value="{{$school->address}}" name="" readonly>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label hor-form">Email:</label>
    <div class="col-sm-10">
       <input type="text" class="form-control" id="inputPassword3" value="{{$school->email}}" readonly>
</div>
    </div>
  </div>
  @else
  <div class="form-horizontal">
  

  <br>

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label hor-form">Name:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputEmail3" value="" name="name" readonly>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label hor-form">Location:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputPassword3" value="" name="" readonly>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label hor-form">Email:</label>
    <div class="col-sm-10">
       <input type="text" class="form-control" id="inputPassword3" value="" readonly>
</div>
    </div>
  </div>
  @endif
</div>
</div>
 			</div>
      <div style="float: right; margin-right: 50px">
        <a href="{{route('csv.search')}}" class="btn btn-success"><i class="fa fa-upload"></i> Upload CSV</a>
      </div>
 	
 		

@stop
@section('styles')
<style type="text/css">
	table, th, td {
    border: 5px solid black;
}
td{
     color: #414244;
}
label{
    color: #414244;
}
.text_color{
     color: #414244;
}
* {
  box-sizing: border-box;
}

#myInput {
  background-image: url({{asset('/css/searchicon.png')}});
  background-position: 10px 10px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}
</style>
@stop

@section('scripts')
<script type="text/javascript">
  $("#originalImage")
    .on('load', function() { console.log("image loaded correctly"); })
    .on('error', function() { 
      $('#originalImage').hide(); 

    })
    .attr("src", $('#originalImage').attr("src"))
;
</script>
@stop
