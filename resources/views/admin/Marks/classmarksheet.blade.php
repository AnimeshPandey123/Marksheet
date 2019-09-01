<!DOCTYPE html>
<html>
<head>
	<title>Marksheet</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	
	<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
	<style type="text/css">
body{
    border:1px solid black;
}
.side{
	margin-left: 7px;
	margin-right: 7px;
}
.mark{
    border: 1px solid black;
    border-spacing: 0em;
}
.mark tr, .mark td, .mark th {
width: 100%;
height:12px; 
    border: 1px solid black;
    

}
.wrapper {
    
    margin: 0 auto;
    border: 1px solid black;
    height: 10%;
}

#block1 {
    float:left;
}

#block2
{
    float:right;
    width: 180px;
}
.result{
    border: 1px solid black;
    text-align: center;
}
 .result td {
width: 100%;
 border: 0.1px solid black;
    

}
.remarks{
	border: 1px solid black;
    text-align: center;
    height: 20%;
}
div.line
{
    height: 1px;
    width: 12%;
    background-color: #000;
}
div.line1{
	height: 1px;
    width: 18%;
   background-color: #000;
    margin-left: -15px;
    margin-right: 20px;
}

	</style>
</head>
<body>
<div>
@foreach($students as $student)
<div style="page-break-inside: avoid;">
@if($school)
<div style=" text-align: center;  ">
<h2 style="font-size: 30px;margin:0" class="text-centre">{{$school->name}}</h2>
<h2 style="font-size: 20px;margin:0" class="text-centre">{{$school->address}}</h2>
<h3 style="font-size: 20px; margin: 0" class="text-centre">{{$terminal->term}} Terminal</h3>
</div>
@endif
<div class="side">

<div class="wrapper" style="text-align: center; height: 5% ">
<div style="display: inline-block; float: center; margin-left: 320px">Roll No. : {{$student['student']->rollno}}</div>
<div id="block1" style="display: inline-block;">Name:{{$student['student']->firstname}} {{$student['student']->middlename}} {{$student['student']->lastname}}</div>
	<div id="block2" style="display: inline-block; float: right; margin-right:100px ">Class: {{$class->name}}</div>	
	
</div>
<br>
<br>
<br>
<table id="mark" class="mark" width="100%" cellspacing="">
<thead>
	<tr>
		<th>Subjects</th>
		<th>Total Marks</th>
		<th>Pass Mark</th>
		<th>Obtained Marks</th>
	</tr>

</thead>
	<tbody>
	@foreach($student['mark'] as $subjectmark)
		<tr>
			
			<td height="1%">{{$subjectmark['name']}}</td>
			<td style="text-align: center;">{{$subjectmark['totalmarks']}}</td>
			<td style="text-align: center;">{{$subjectmark['passmarks']}}</td>
			<td style="text-align: center;">{{$subjectmark['mark']}}</td>
			
		</tr>
		@endforeach
			
		<tr>
		<td style="text-align: center;"><span>
			<label>Total Marks</label></span></td>
			<td style="text-align: center;">{{$total}}</td>
			<td style="text-align: center;">{{$pass}}</td>
			<td style="text-align: center;">@if($student['final']->total_mark)
				{{$student['final']->total_mark}}
				
				@endif</td>
		</tr>
	</tbody>
</table>	
<br>
<br>
<div class="container">
	<div class="" style="float: left;">
	<table class="result" width="30%" cellspacing="0.1">
	<thead>
	<tr style="text-align: center; ">
		<th style="text-align: center; font-size: large;" height="1%">
			Result
		</th>
	</tr>
		
	</thead>
	<tbody>
			<tr>
			<td width="40%" style="height: 5%">
				Percentage
			</td>
			<td>
				@if($student['final']->percentage)
				{{$student['final']->percentage}} %
				
				@endif
			</td>
		</tr>
		<tr>
			<td height="5%">
				Grade
			</td>
			<td>
				@if($student['final']->grade)
				{{$student['final']->grade}}
				
				@endif
			</td>
		</tr>
		@if($student['final']->grade_point)
		<tr>
			<td height="5p%">
				Grade point
			</td>
			<td>
				@if($student['final']->grade_point)
				{{$student['final']->grade_point}}
				
				@endif
			</td>
		</tr>
		@endif
		</tbody>
</table>
<br><br><br><br>
@if(empty($student['final']->grade_point))
	<br><br>
@endif
<div style=" font-size: 100%; margin-left: 70px;">
	<label style="">{{$today}}</label>
	<br>
	<div class="line"></div>
<label id="date" style="font-size: 150%; margin-left: 10px">
	Date
</label>
	</div>
</div>
<div class=""  style="float: right;">
<table width="30%" style="" class="remarks">
<thead>
	<tr>
			<td style="" height="1">
				<label>Remarks:</label>
			</td>
	</tr>
</thead>
	<tbody>
		<tr>		
			<td style="text-align: center;" height="1">
				<label>@if($student['final']->details)
				{{$student['final']->details}}
				
				@endif</label>
			</td>
		</tr>
	</tbody>
</table>
<br><br><br><br><br>

	<div style="margin-left: 10px;">
	<div class="line1"></div>
		<label style="font-size: 150%; ">
			Principal
		</label>
	</div>			
</div>


</div>

<br>
<br>
<br>
<br>


</div>

</div>
</div>
@if(!$loop->last)
<div style="page-break-after: always;"></div>
@endif

@endforeach
</body>
</html>