@extends('layouts.new')

@section('content')
@include('admin.includes.error')
	<!--banner-->	
<div class="banner">
				<h2>
				<a href="#">Home</a>
				<i class="fa fa-angle-right"></i>
				<span>Add Mark</span>
				</h2>
</div>
<!--//banner-->
	
		<div class="content-top">
			
			
			<div class="grid-1 ">
			<div class="grid-form1">
			<h3 id="forms-example" class=""><i class="fa fa-plus"></i>&nbsp;Add Marks</h3>

			<form action="{{route('class.terminal.mark')}}" method="get" enctype="multipart/form-data">
				

					<div class="form-group">
						<strong>Class</strong>
						<br>
						<select name="class_id" id="class" class="form-control boxe"> 
							@foreach($classes as $class)
								<option value="{{ $class->id }}">{{ $class->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<strong>Terminal </strong>
						<select name="terminal_id" id="" class="form-control boxe"> 
							@foreach($terminals as $terminal)
								<option value="{{ $terminal->id }}">{{ $terminal->term }} </option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<strong>Academic Year </strong>
						<select name="year_id" id="" class="form-control"> 
							@foreach($years as $year)
								<option value="{{ $year->id }}">{{ $year->year }} </option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<strong>Select Method to store mark</strong>
							<select name="method" class="form-control">
								<option value="1">By Student</option>
								<option value="0">By Subject</option>
							</select>
						
					</div>
					
					<div class="text-center">
							<button class="btn btn-default" type="submit" >
								<i class="fa fa-search-plus"></i>
								Search
							</button>

					</div>

					

			</form>
			</div>
				
		</div>



	</div>

	
@stop
@section('styles')


@stop
@section('scripts')

 @if($students)
 @if($students->isEmpty())
 @else
  @foreach($students as $student)
<script type="text/javascript">
 $(document).ready(function(){
      // console.log($(this).val()); // the selected options’s value
 
   $.ajax({
        type: "GET",
        url: "{{ route('update.mark.each') }}",
        data: {"terminal_id":{{$terminal_id}},"student_id":{{$student->id}}},
        success: function (students){
           // location.reload();
          console.log(students);
         
        },
        error: function(){
          console.log('error');
        }
      }); 
    }); 
</script>
@endforeach
@endif
@endif



@stop