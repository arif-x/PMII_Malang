<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width">
</head>
<body style="margin:0">
  	@foreach($modules as $modul)
    <div style="width: 100%; height: 100vh">
    	<embed id="frPDF" height="100%" width="100%" src="http://localhost:8000/storage/modul/{{ $modul->post }}"></embed>
    </div>
    @endforeach
</body>
</html>