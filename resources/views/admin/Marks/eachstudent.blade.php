@extends('layouts.new')
@section('content')

 				
 			<div class="banner">
                <h2>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
                <span>Show Student</span>
                </h2>
</div>
<!--//banner-->
    
        <div class="content-top">
            

            
            <div class="grid-1 ">
 			<br>
          <h5>Select a student to add mark</h5>
          <br>
            <h1>Student of Class {{$class->name}}</h1>
 			<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for name.." title="Type in a name">
 			<table class="table table-striped" id="myTable">	
 			<thead>
      <th>
        Roll No.
      </th>
 			<th>
 				Student Name
 			</th>
            

 			</thead>
 			<tbody>
 				@if(count($students)>0)
 				
 				@foreach($students as $data)
                   
                    <tr>
                    <td>
                      {{$data->rollno}}
                    </td>
                    <td>
                    <a href="{{route('class.terminal.student.mark',['student_id'=>$data->id,'class_id'=>$class->id,'terminal_id'=>$terminal->id])}}">
                        {{$data->firstname}} {{$data->middlename}} {{$data->lastname}}
                    </a>
                        
                    </td>
                       </tr>
 				
 				

 				@endforeach
 			@else
 			<tr>
 					<th colspan="5" class="text-center">
 						Add Student First
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
<script type="text/javascript" src="{{asset('js/jquery.tablesorter.js')}}" ></script>
<script type="text/javascript">
    $(document).ready(function() 
    { 
        $("#myTable").tablesorter(); 
    } 
); 
</script>
<script type="text/javascript">
function myFunction() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>

@stop