@extends('layouts.new')

@section('content')
@include('admin.includes.error')
<!--banner-->	
<div class="banner">
				<h2>
				<a href="#">Home</a>
				<i class="fa fa-angle-right"></i>
				<span>Add Students</span>
				</h2>
</div>
<!--//banner-->
<div class="content-top">

	<div class="grid-1">
			<h3 id="forms-example" class="">Add Students of Class {{$class->name}}</h3>
		<div class="grid-form1">
			<form action="{{route('student.add.store',['class_id'=>$class->id])}}" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
					
					<div class="form-group">
						<STRONG>Select Academic Year</STRONG>
						<select name="year_id" id="class" class="form-control boxe"> 
							@foreach($years as $year)
								<option value="{{ $year->id }}">{{ $year->year }}</option>
							@endforeach
						</select>
					</div>

			<div class="table-responsive"> 
			<table class="table table-hover" id="dynamic_field">	
 			<thead><button id="add" class="btn btn-success" type="button"><i class="fas fa-plus-circle"></i> Add more Student</button> &nbsp;<span>You can add mulitple students by clicking this button.</span>
 			<th>
 				<label>Roll No.</label>
 			</th>
 			<th>
 			<label>First Name </label>
 			</th>
 			<th>
 				<label>Middle Name</label>
 			</th>
            <th>
            <label> Last Name</label>
               
            </th>
            

 			</thead>
 			<tbody>
 				<tr>
 				<td>
 					<input type="text" name="student1[roll]" class="form-control" placeholder="Roll No." required>
 				</td>
 					<td>
 						<input type="text" name="student1[fname]" class="form-control" placeholder="First Name" required> 
 					</td>
 					<td>
 						<input type="text" name="student1[mname]" class="form-control" placeholder="Middle Name (optional)"> 
 					</td>
 					<td>
 						<input type="text" name="student1[lname]" class="form-control" placeholder="Last Name" required> 
 					</td>
 					
 				</tr>
 				
 				
 			
 			</tbody>


 			</table>
					</div>

					<div class="col-sm-8 col-sm-offset-2">
							<button class="btn btn-success" type="submit" >
								<i class="fa fa-upload"></i>
								Post Now
							</button>

					</div>

					

			</form>
				
		</div>



	</div>
	</div>
	
@endsection
@section('styles')
<style type="text/css">
	.btn_remove {border-radius: 8px;}
</style>
@endsection
@section('scripts')
<script type="text/javascript">

	// window.onload = function() {
 //    if (window.jQuery) {  
 //        // jQuery is loaded  
 //        alert("Yeah!");
 //    } else {
 //        // jQuery is not loaded
 //        alert("Doesn't Work");
 //    }
// }
	 $(document).ready(function(){   
	 // alert('ok');   
     
      var i=1;  
      var j=100


      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="student'+i+'[roll]" class="form-control" placeholder="Roll No." required></td><td><input type="text" name="student'+i+'[fname]" placeholder="First Name" class="form-control name_list" required /></td><td><input type="text" name="student'+i+'[mname]" placeholder="Middle Name (Optional)" class="form-control name_list" /></td><td><input type="text" name="student'+i+'[lname]" placeholder="Last Name" class="form-control name_list" required /></td><td><button type="button" name="+i+" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
      });  


      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  


      
      });
</script>
@endsection