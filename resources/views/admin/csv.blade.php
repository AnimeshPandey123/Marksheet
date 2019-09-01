<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form action="{{route('csv')}}" enctype="multipart/form-data" method="post">
{{csrf_field()}}
	<input type="file" name="file">
	<input type="submit" name="">
</form>
</body>
</html>