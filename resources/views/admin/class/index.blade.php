@extends('layouts.new')
@section('content')
<!--banner-->
		    <div class="banner">

				<h2>
				<a href="#">Home</a>
				<i class="fa fa-angle-right"></i>
				<span>Classes</span>
				</h2>
		    </div>
<!--//banner-->
<div class="content-top">


			<div class="grid-1 ">
 				<h3>Classes</h3>
 			<br>
 			 <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for name.." title="Type in a name">
 			<div class="">
 			<table id="myTable" class="table table-hover table-bordered">
 			<thead>
 			<th>
 				<label>Class Name</label>
 				<i id="calloutpop" class="fas fa-sort"></i>
 			</th>
 			<th>
 				<label>Class Teacher</label>
 				<i id="calloutpop" class="fas fa-sort"></i>
 			</th>

 			<th>
 				<label>No. of Students</label>
 				<i id="calloutpop" class="fas fa-sort"></i>
 			</th>
      <th>
        <label>Add Students</label>
      </th>
      <th>
        <label>View Students </label>
      </th>


 			</thead>
 			<tbody>
 				@if(count($classes)>0)

 				@foreach($classes as $class)
 				<tr>
 				<td>
 					<a class="text_color" href="{{route('class.terminal',['id'=>$class->id])}}">{{$class->name}}</a>
 				</td>
 				<td>
 					<label>{{$class->class_teacher}}</label>
 				</td>
 				<td>
 					<label>{{$class->students->count()}}</label>
 				</td>
        <td>
          <a href="{{route('student.add',['class_id'=>$class->id])}}">Add Students</a>
        </td>
        <td>
          <a href="{{route('student.view',['class_id'=>$class->id])}}">View Students</a>
        </td>
 				</tr>


 				@endforeach
 			@else
 			<tr>
 					<th colspan="5" class="text-center">
 						No class
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

    });


</script>
<script type="text/javascript">
function myFunction() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
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
      toastr.info("Click on the class to view the mark of students")
        
</script>
@stop
