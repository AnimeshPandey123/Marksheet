@extends('layouts.new')
@section('content')
<!--banner-->	
		    <div class="banner">
		   
				<h2>
				<a href="#">Home</a>
				<i class="fa fa-angle-right"></i>
				<span>Terminal</span>
				</h2>
		    </div>
<!--//banner-->
<div class="content-top">
			
			
			<div class="grid-1 ">
 				<h3>Terminal</h3>
 			<br>
 			<div class="">
 			<table class="table table-hover table-bordered">	
 			<thead>
 			<th>
 				<label>Terminals</label>
 			</th>
 			
 			
 			
 			

 			</thead>
 			<tbody>
 				@if(count($terminals)>0)
 				
 				@foreach($terminals as $terminal)
 				<tr>
 				<td>
 					<label>{{$terminal->term}}</label>
 				</td>
 				
 				
 					
 				</tr>
 				

 				@endforeach
 			@else
 			<tr>
 					<th colspan="5" class="text-center">
 						No terminal
 						</th>
 					
 				</tr>
 				@endif
 			</tbody>


 			</table>	
 			</div>
 			</div>
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
</style>
@stop