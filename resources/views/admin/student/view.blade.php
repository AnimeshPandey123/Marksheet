@extends('layouts.new')
@section('content')
<div class="banner">
        <h2>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
                <span>Students</span>
                </h2>
</div>
<!--//banner-->
    
        <div class="content-top">
            

            
            <div class="grid-1 ">
            <h2>Students of Class <strong>{{$class->name}}</strong></h2>
            <div style="float: right;">
            <span><h3 >Select a specific academic year</h3> <br>
            <select name="year_id" id="year" class="form-control">

              @foreach($years as $year)
              <option value="1" selected disabled hidden>Choose Year</option>
                <option value="{{ $year->id }}">{{$year->year}}</option>
              @endforeach
            </select></span></div>
            <br>
            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for name.." title="Type in a name">
      <table class="table table-bordered tablesorter" id="myTable"> 
      <thead>
        <th>
          <label>Roll No.</label>
        </th>
            <th>
                <label>Name</label>
                <i id="calloutpop" class="fas fa-sort"></i>
            </th>
            <th>
                <label>Academic Year</label>
                <i id="calloutpop" class="fas fa-sort"></i>
            </th>
      
            
      

      </thead>
      <tbody id="newtable">
        @if(count($students)>0)
        
        @foreach($students as $student)
                   
                    <tr>
                    <td>
                      <label>{{$student->rollno}}</label>
                    </td>
                        <td>
                            
                          <label>{{$student->firstname}} {{$student->middlename}} {{$student->lastname}}</label>
                         </td>
               
                 <td>
                    <label>{{$student->academicyear->year}}</label>
                </td>
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
  $(document).on('change', 'select', function() {
    // console.log($(this).val()); // the selected options’s value
    var year_id = $(this).val();
     var opt = $(this).find('option:selected')[0].text;
   $.ajax({
        type: "GET",
        url: "{{ route('student.get') }}",
        data: {"year_id":year_id,"class_id":{{$class->id}}},
        success: function (students){
          //$("select[name=class]").html(data);
          $('#newtable').html('');
          $.each(students, function(i, student){
            if (student.middlename == null) {
              student.middlename = '';
            }
            $('#newtable').append('<tr><td><label>'+student.rollno+'</label></td><td><label>'+student.firstname+' '+student.middlename+' '+student.lastname+'</label></td><td><label>'+opt+'</label></td></tr>');
            console.log(student);
          });
     
         
          // console.log(students);
        }
      });   
    // if you want to do stuff based on the OPTION element:
   

    // console.log(opt);
    // use switch or if/else etc.
});
</script>
@stop