@extends('layouts.new')
@section('content')
<div class="banner">
        <h2>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
                <span>Mark of each subject</span>
                </h2>
</div>
<!--//banner-->
    
        <div class="content-top">
            

            
            <div class="grid-1 ">
            <h2>Class {{$class->name}}</h2>
            <br>
            
 			<h3>Marks of {{$student->firstname}} {{$student->middlename}} {{$student->lastname}}
            of {{$terminal->term}} Term</h3>
            <br>
            <div style="float: left;"><a href="{{route('mark.edit',['student_id'=>$student->id,'terminal_id'=>$terminal->id])}}"><i class="fa fa-edit"></i>Edit Result</a></div>
            <div style="float: right"><h3></i><a href="{{route('marksheet',['student_id'=>$student->id,'terminal_id'=>$terminal->id])}}" target="_blank"> <i id="calloutpop" class="fa fa-print" ></i>Print result</a></h3></div>
 			<table class="table table-bordered">	
 			<thead>
 			<th>
 				<label>Subject Name</label>
 			</th>
            <th>
                <label>Total Mark</label>
            </th>
            <th>
                <label>Pass Marks</label>
            </th>
 			<th>
 				<label>Mark Obtained</label>
 			</th>
 			
 			
 			

 			</thead>
 			<tbody>
 				@if(count($subjectmarks)>0)
 				
 				@foreach($subjectmarks as $data)
                   
                    <tr>
                        <td>
                            <label>{{$data['name']}}</label>
                        </td>
                        <td>
                            <label>{{$data['totalmarks']}}</label>
                        </td>
                        <td>
                            <label>{{$data['passmarks']}}</label>
                        </td>
                        <td>
                           <label>{{ $data['mark']}}</label>
                        </td>
                    </tr>
                    
 				
 				

 				@endforeach
 			@else
 			<tr>
 					<th colspan="5" class="text-center">
 						No Marks added
 						</th>
 					
 				</tr>
 				@endif
 			</tbody>


 			</table>	
 			</div>
 			
 		</div>
 		

@stop
@section('styles')
<style type="text/css">
	table, th, td {
    border: 1px solid black;
}
label{
    color: #414244;
}
</style>
@stop