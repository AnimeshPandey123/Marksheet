@extends('layouts.new')

@section('content')
@include('admin.includes.error')
<!--banner-->	
<div class="banner">
				<h2>
				<a href="#">Home</a>
				<i class="fa fa-angle-right"></i>
				<span>Add Subject</span>
				</h2>
</div>
<!--//banner-->
<div class="content-top">

	<div class="grid-1">
			<h3 id="forms-example" class="">Add Subject</h3>
		<div class="grid-form1">
			<form action="{{route('subject.store')}}" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
					<div class="form-group">
						<STRONG>Select Class</STRONG>
						<select name="class_id" id="class" class="form-control boxe"> 
							@foreach($classes as $class)
								<option value="{{ $class->id }}">{{ $class->name }}</option>
							@endforeach
						</select>
					</div>

					<!-- <div class="form-group">
						<strong>Name</strong>
						<input type="text" name="name" value="{{ old('name') }}" class="form-control boxe" placeholder="Enter Name">
					</div>
					<div class="form-group">
						<strong>Total Mark</strong>
						<input type="text" name="totalmarks" value="{{ old('totalmarks') }}" class="form-control boxe" placeholder="Enter its total mark">
					</div> -->
					<div class="table-responsive"> 
					<table class="table table-hover" id="dynamic_field">	
 			<thead><button id="add" class="btn btn-success" type="button"><i class="fas fa-plus-circle"></i> Add more Subject</button> &nbsp;<span>You can add mulitple subjects by clicking this button.</span>
 			<th>
 			<label>Subject Name </label>
 				
 			</th>
            <th>
            <label> Total Mark</label>
               
            </th>
            <th>
            	<label>Pass Mark</label>
            </th>

 			</thead>
 			<tbody>
 				<tr>
 					<td>
 						<input type="text" name="subject1[name]" class="form-control" placeholder="Name of Subject" required autocomplete="off"> 
 					</td>
 					<td>
 						<input type="number" name="subject1[totalmark]" class="form-control" placeholder="Total Mark of the subject" required autocomplete="off"> 
 					</td>
 					<td>
 						<input type="number" name="subject1[passmark]" class="form-control" placeholder="Pass Mark" required autocomplete="off">
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
           $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="subject'+i+'[name]" placeholder="Subject Name" class="form-control name_list" required autocomplete="off"></td><td><input type="number" name="subject'+i+'[totalmark]" placeholder="Total Mark Name" class="form-control name_list" required autocomplete="off"></td><td><input type="number" name="subject'+i+'[passmark]" class="form-control" placeholder="Pass Mark" required autocomplete="off"></td><td><button type="button" name="+i+" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
      });  


      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  


      
      });
</script>
@endsection