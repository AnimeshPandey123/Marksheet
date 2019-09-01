@extends('layouts.new')
@section('abovescript')
 
@stop
@section('content')
<div class="banner">
        <h2>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
                <span>Marksheet</span>
                </h2>
</div>
<!--//banner-->
    
        <div class="content-top">
            

            
            <div class="grid-1 ">
            <h2 style="float: left;">Marks of Class <strong>{{$class->name}}</strong> of {{$terminal->term}} Term of Year @if($year){{{$year->year}}} @endif</h2>
            <div style="float: right;"><a style="font-size: large;" href="{{route('marksheet.class',['class_id'=>$class->id,'year_id'=>$year->id,'terminal_id'=>$terminal->id])}}" target="_blank"><i class="fa fa-print"></i> Print Marksheet</a></div>
            <br>
            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for name.." title="Type in a name">
 			<table class="table table-bordered tablesorter" id="myTable">	
 			<thead>
      <th>
        <label>
          Roll No.
        </label>
      </th>
 			<th>
 				<label>Student Name</label>
 			</th>
            <th>
                <label>Terminal</label>
            </th>
            <th>
                <label>Academic Year</label>
            </th>
 			<th>
 				<label>Percentage</label>
 			</th>
 			
 			<th>
            <label>Grade/Division</label>
 			</th>
 			<th>
            <label>Detail/Explanation</label>	
 			</th>
 			<th>
 				<label>Grade Point</label>
 			</th>
            
 			

 			</thead>
 			<tbody>
 				@if(count($datas)>0)
 				
 				@foreach($datas as $data)
                   
                    <tr>
                    <td>
                      <label>{{$data['rollno']}}</label>
                    </td>
                        <td>
                            
                           <a class="text_color" href="{{route('student.subject.mark',['student_id'=>$data['student_id'],'terminal_id'=>$terminal->id])}}">{{$data['firstname']}} {{$data['middlename']}} {{$data['lastname']}}</a>
                         </td>
                <td>
                    <label>{{$terminal->term}}</label>
                </td>
                 <td>
                    <label>{{$data['year']}}</label>
                </td>
                @if(($data['percentage']) == null)
                <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                @else
                <td>
                    <label>{{($data['percentage'])}}</label>
                </td>
                <td>
                    <label>{{($data['grade'])}}</label>
                </td>
                <td>
                    <label>{{($data['details'])}}</label>                
                </td>
                <td>
                    <label>{{($data['grade_point'])}}</label>                
                </td>
               
                   
                @endif
                
                    
                    
                </tr>
                    
 				
 				

 				@endforeach
 			@else
 			<tr>
 					<td colspan="5" class="text-center">
 						<label>No Student</label>
 						</td>
 					
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
<script type="text/javascript" src="{{asset('js/jquery.tablesorter.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/tablesort.min.js')}}"></script>
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
<script type="text/javascript">
   toastr.info("Click on Student to view mark of each subject")
</script>

@if(count($datas)>0)
  @foreach($datas as $student)

<script type="text/javascript">

 $(document).one('ready',function(){
    
    // console.log($(this).val()); // the selected options’s value
 
   $.ajax({
        type: "GET",
        url: "{{ route('update.mark.each') }}",
        data: {"terminal_id":{{$terminal->id}},"student_id":{{$student['student_id']}}},
        success: function (students){
           // location.reload();
          // console.log(students);
         
        },
        error: function(){
          console.log('error');
        }
      }); 
    }); 


</script>
@endforeach
@endif 
@stop