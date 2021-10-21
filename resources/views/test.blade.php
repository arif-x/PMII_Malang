<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="/assets/img/favicon1.png" type="image/png">

    <!-- ===== BOX ICONS ===== -->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/styles_slider.css') }}">    
    
    <!-- Styles -->
    <link href="{{ asset('lib/datatables/DataTables-1.10.23/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <script src="{{ URL::asset('lib/datatables/jQuery-3.3.1/jquery-3.3.1.min.js') }}"></script>
</head>
<body>
	<div id="cuk">
        @php
        echo 
        @endphp
    </div>
</body>
</html>