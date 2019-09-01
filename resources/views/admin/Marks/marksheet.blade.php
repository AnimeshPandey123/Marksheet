<!DOCTYPE html>
<html>
<head>
	<title>Marksheet</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<style type="text/css">
.wrapper {
    width:700px;
    margin: 0 auto;
    border: 1px solid black;
    height: 4%;
}

#block1 {
    float:left;
}

#block2
{
    float:right;
    width: 180px;
}
	</style>
	<style type="text/css">
body{
    border:1px solid black;
}
table,tr {
    border: 1px solid black;
}
.intro{
	 border: 1px solid black;
}
.text-centre{
	 text-align: center;
}
.side{
	margin-left: 7px;
}
.table-mark {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

.table-mark td, .table-mark th {
    border: 1px solid #ddd;
    padding: 8px;
}


.table-mark th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: black;
    color: white;
}
div.line
{
    height: 1px;
    width: 20%;
    background-color: #000;
}
div.line1{
	height: 1px;
    width: 14%;
   background-color: #000;
    margin-left: 0px;
    margin-right: 20px;
}


</style>
<style type="text/css">
	.table-mark2 {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border: 1px solid black;
    border-collapse: separate;
   
}

.table-mark2 td, .table-mark tr {
    border: 1px solid black;
    padding: 8px;
}

 .table-mark th{
   
    text-align: center;
  
}
</style>
<style>
.flex-container {
  display: flex;
  flex-wrap: nowrap;
}

.flex-container > div {
  background-color: ;
  width: 700px;
}
</style>
</head>
<body>
@if($school)
<div style="border: 1px solid black">
	<h1 class="text-centre">{{$school->name}}</h1>
<h3 class="text-centre">{{$school->address}}</h3>
<h2 class="text-centre">{{$terminal->term}} Terminal</h2>
</div>

@endif


<div class="side">
<div class="wrapper">
	<div id="block1" >Name: {{$student->firstname}} {{$student->lastname}}</div>
	<div id="block2">Class: {{$class->name}}</div>		
</div>
<table id="mark" class="table-mark" width="100%">
<thead>
	<tr>
		<th>Subjects</th>
		<th>Total Marks</th>
		<th>Pass Mark</th>
		<th>Obtained Marks</th>
	</tr>

</thead>
	<tbody>
	@foreach($subjectmarks as $subjectmark)
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
			<td style="text-align: center;">{{$mark->total_mark}}</td>
		</tr>
	</tbody>
</table>	
<br>
<br>
<div class="container">
	<div class="" style="">
	<table class="table-mark2" width="30%" cellspacing="0.1">
	<thead>
	<tr style="text-align: center;">
		<th style="text-align: center; font-size: large;" height="1%">
			Result
		</th>
	</tr>
		
	</thead>
	<tbody>
			<tr>
			<td width="40%" style="height: 1%">
				Percentage
			</td>
			<td>
				{{$mark->percentage}} %
			</td>
		</tr>
		<tr>
			<td height="1%">
				Grade
			</td>
			<td>
				{{$mark->grade}}
			</td>
		</tr>
		<tr>
			<td height="1px">
				Grade point
			</td>
			<td>
				{{$mark->grade_point}}
			</td>
		</tr>
		</tbody>
</table>
<br><br><br><br><br><br>
<div style="font-size: 80%; margin-left: 50px; ">
	<label style="font-size: 120%; margin-left: 20px;">{{$today}}</label>
	<br>
	<div class="line"></div>
<label id="date" style="font-size: 150%; margin-left: 30px">
	Date
</label>
	</div>
</div>
<div class=""  style="">
<table width="30%" style="" class="table">
<thead>
	<tr>
			<td style="text-align: center;" height="1">
				<label>Remarks:</label>
			</td>
	</tr>
</thead>
	<tbody>
		<tr>		
			<td style="text-align: center;" height="1">
				<label>{{$mark->details}}</label>
			</td>
		</tr>
	</tbody>
</table>
<br><br><br><br><br><br><br><br>

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


</body>
</html>