<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="POST" action="/test-cuk" enctype="multipart/form-data">
		@csrf
		<input type="file" name="pasFoto">
		<button type="submit">Sumbi</button>
	</form>
</body>
</html>