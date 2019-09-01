@extends('layouts.new')
@section('content')
<!--banner-->	
		    <div class="banner">
		   
				<h2>
				<a href="#">Home</a>
				<i class="fa fa-angle-right"></i>
				<span>Subjects</span>
				</h2>
		    </div>
<!--//banner-->
<div class="content-top">
			
			
			<div class="grid-1 ">
 				<h3>Subjects</h3>
 			<br>
 			<div class="">
             <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for name.." title="Type in a name">
             <div style="float: right;" class="form-group-lg">
               <select name="class_id" class="form-control input-md" >
                @foreach($classes as $class)
                <option value="null" selected disabled hidden>Select Class</option>
                  <option value="{{$class->id}}">
                      {{$class->name}}
                  </option>
                @endforeach
                </select>
             </div>
 			<table id="myTable" class="table table-hover table-bordered">	
 			<thead>
 			<th id="callout">
 				<label>Subject Name</label>
 				<i id="calloutpop" class="fas fa-sort"></i>
 			</th>
 			<th>
 				<label>Total Mark</label>
 			</th>
 			<th>
     <label>Pass Mark</label>   
      </th>
 			<th>
 				<label>Class</label>
 			</th>
 			

 			</thead>
 			<tbody id="body">
 				@if(count($subjects)>0)
 				
 				@foreach($subjects as $subject)
 				<tr>
 				<td>
 					<label>{{$subject->name}}</label>
 				</td>
 				<td>
 					<label>{{$subject->totalmarks}}</label>
 				</td>
        <td>
          <label>{{$subject->passmarks}}</label>
        </td>
 				<td>
 					<label>{{$subject->sclass->name}}</label>
 				</td>
 					
 				</tr>
 				

 				@endforeach
 			@else
 			<tr>
 					<th colspan="5" class="text-center">
 						No Subject
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
<script type="text/javascript" src="{{asset('js/jquery.tablesorter.js')}}" ></script>
<script type="text/javascript">
    $(document).ready(function() 
    { 
        $("#myTable").tablesorter(); 

        // hides the slickbox as soon as the DOM is ready
        jQuery('#calloutpop').show();
        jQuery('#callout').hover(function() {
            jQuery('#calloutpop').fadeIn(100);
        });
        jQuery('#callout').mouseleave(function(event) {
                jQuery('#calloutpop').fadeOut(100);
        });
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
  
  
  $(document).on('change', 'select', function() {
    
    // console.log($(this).val()); // the selected options’s value
    var class_id = $(this).val();
    // console.log(subject_id);
   
     var opt = $(this).find('option:selected')[0].text;
   $.ajax({
        type: "GET",
        url: "{{ route('subject.class') }}",
        data: {"class_id":class_id},
        success: function (subjects){
          //$("select[name=class]").html(data);
         $('#body').html('');
         // console.log(students);
         if (subjects.length > 0) {
         
           $.each(subjects, function(i, subject){
            
            console.log(subject)
            $('#body').append(' <tr class="warning"><td><label>'+subject.name+'</label></td><td><label>'+subject.totalmarks+'</label></td><td><label>'+subject.passmarks+'</label></td><td><label>'+opt+'</label></td></tr>');
            // console.log(student);
          });
         }
         else{
           $('#body').append(' <tr class="warning"><td><label>You have not added any subject to this class. Please add subject to this class.</labl></td></tr>');
         }
     
         
          // console.log(students);
        },
        error: function(){
          console.log('error');
        }
      }); 
    });  
</script>
@stop
