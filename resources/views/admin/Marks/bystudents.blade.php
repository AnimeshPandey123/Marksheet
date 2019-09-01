@extends('layouts.new')
@section('content')
<div class="banner">
        <h2>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
                <span>Add Mark of Students</span>
                </h2>
</div>
<!--//banner-->
    
        <div class="content-top">
            

            
            <div class="grid-1 ">
           Class <strong>{{$class->name}}</strong> of <strong> {{$terminal->term}}</strong> Terminal
      
      <div class="grid-form1">
      <form class="form-horizontal" action="{{route('class.mark.store',['class_id'=>$class->id,'terminal_id'=>$terminal->id])}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <select name="subject_id" class="form-control">
                @foreach($subjects as $subject)
                <option value="null" selected disabled hidden>Select Subject</option>
                  <option value="{{$subject->id}}">
                      {{$subject->name}}
                  </option>
                @endforeach
                </select>
      <table class="table table-condensed"> 
      <div class="form-group">
          <thead>
          <th>
            Roll No.
          </th>
      <th>
        Student Name
      </th>
            <th>
                Mark Obtained
            </th>
            

      </thead>
      </div>
    
      <tbody id="newtable">
      <div class="form-group">
        @if(count($students)>0)
        
        @foreach($students as $data)
                   <tr class="warning">
                   <td>
                     <label>{{$data->rollno}}</label>
                   </td>
                       <td>
                           <label>{{$data->firstname}} {{$data->middlename}} {{$data->lastname}}</label>
                       </td>
                       <td>
                           <input type="number"  name="{{$data->id}}" required autocomplete="off">
                       </td>
                   </tr>
                    

        @endforeach
      @else
      <tr>
          <th colspan="5" class="text-center">
          You have already added of all these student in this terminal.
        </th> 
      </tr>
      @endif
      </div>
        
      </tbody>


      </table>
      <br>
      <div class="col-sm-8 col-sm-offset-2">
          <button id="button" class="btn btn-default text-center" type="submit"><i class="fa fa-upload"></i>Save</button>  
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
    label{
      color: black;
    }
</style>
@stop
@section('scripts')
<script type="text/javascript">
  toastr.info("Make Sure You have selected right subject")
</script>
<script type="text/javascript">

      $('#button').hide();
  
  $(document).on('change', 'select', function() {
    
    // console.log($(this).val()); // the selected options’s value
    var subject_id = $(this).val();
    // console.log(subject_id);
   
     var opt = $(this).find('option:selected')[0].text;
   $.ajax({
        type: "GET",
        url: "{{ route('subject.filter') }}",
        data: {"terminal_id":{{$terminal->id}},"subject_id":subject_id,"class_id":{{$class->id}},"year_id":{{$year->id}}},
        success: function (students){
          //$("select[name=class]").html(data);
          console.log(students.totalmark);
         $('#newtable').html('');
         // console.log(students);
         if (students.students.length > 0) {

          $('#button').show();
           $.each(students.students, function(i, student){
                console.log(student);
            if (student.middlename == null) {
              student.middlename = '';
            }

            $('#newtable').append(' <tr><td><label>'+student.rollno+'</label></td><td><label>'+student.firstname+' '+student.middlename+' '+student.lastname+'</label></td><td><input autocomplete="off" type="number"  name="'+student.id+'" required max="'+students.totalmark+'"></td></tr>');
            // console.log(student);
          });
         }
         else{
          $('#newtable').append(' <tr class="warning"><td><label>You have already stored all the students data of this subject. Please Select another subject.</labl></td></tr>');
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
