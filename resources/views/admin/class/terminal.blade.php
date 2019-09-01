@extends('layouts.new')
@section('content')
<div class="banner">
        <h2>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
                <span>Select Terminal</span>
                </h2>
</div>
<!--//banner-->
    
        <div class="content-top">
            

            
            <div class="grid-1 ">
 				<h2>For Class {{$class->name}}</h2>
 			
 			<br>
 			<table class="table table-hover table-bordered">	
 			<thead>
 			<th>
 				Select Terminal
 			</th>
 			
 			

 			</thead>
 			<tbody>
 				@if(count($terminals)>0)
 				
 				@foreach($terminals as $terminal)
 				<tr>
 				<td>
 					<a href="{{route('class.marks',['class_id'=>$class->id,'terminal_id'=>$terminal->id])}}">{{$terminal->term}}</a>
 				</td>
 				
 					
 				</tr>
 				

 				@endforeach
 			@else
 			<tr>
 					<th colspan="5" class="text-center">
 						No terminals added
 						</th>
 					
 				</tr>
 				@endif
 			</tbody>


 			</table>	
 			</div>
 			</div>
 		</div>
 		

@stop