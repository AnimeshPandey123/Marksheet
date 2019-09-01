@extends('layouts.new')
@section('content')
<div class="banner">
        <h2>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
                <span>Add Mark of Student</span>
                </h2>
</div>
<!--//banner-->
    
        <div class="content-top">
            

            
            <div class="grid-1 ">
           Roll No. :{{$student->rollno}} <br> 
           {{$student->firstname}} {{$student->lastname}} of Class <strong>{{$class->name}}</strong> of <strong> {{$terminal->term}}</strong> Terminal
 			
      <div class="grid-form1">
            <form action="{{route('class.terminal.student.mark.store',['student_id'=>$student->id,'class_id'=>$class->id,'terminal_id'=>$terminal->id])}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

 			<table class="table table-condensed">	
      <div class="form-group">
          <thead>
      <th>
        Subject Name
      </th>
            <th>
                Mark Obtained
            </th>
            

      </thead>
      </div>
 		
 			<tbody id="tbody">
      <div class="form-group">
        @if(count($subjects)>0)
        
        @foreach($subjects as $data)
                   <tr class="warning">
                       <td>
                           <label>{{$data->name}}</label>
                       </td>
                       <td>
                           <input type="number"  name="{{$data->id}}"  max="{{$data->totalmarks}}" required autocomplete="off">
                       </td>
                   </tr>
                   
        

        @endforeach
      @else
      
        @endif
      </div>
 				
 			</tbody>


 			</table>
      <br>
      <div class="col-sm-8 col-sm-offset-2">
          <button id="save" class="btn btn-default" type="submit"><i class="fa fa-upload"></i> Save</button>  
      </div>
            
            </form>
 			</div>
 			
 		</div>
</div> 		

@stop
@section('style')
<style type="text/css">
	table, th, td {
    border: 1px solid black;
}
</style>
@stop
@section('scripts')
<script type="text/javascript">
  var tbody = $("#tbody");

if (tbody.children().length == 0) {
    $('#save').hide();
    tbody.append('<tr><th colspan="5" class="text-center">All mark of Subject is added</th></tr>');
}
</script>
@stop