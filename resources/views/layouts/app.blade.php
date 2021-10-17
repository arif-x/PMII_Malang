<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- ===== BOX ICONS ===== -->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/styles_slider.css') }}">    
    
    <!-- Styles -->
    <link href="{{ asset('lib/datatables/DataTables-1.10.23/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('lib/bootstrap/css/bootstrap.min.css') }}">
    <link href="{{ asset('lib/datatables/FixedColumns-3.3.2/css/fixedColumns.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('lib/font-awesome/css/font-awesome.min.css') }}">

    <script src="{{ URL::asset('lib/datatables/jQuery-3.3.1/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ URL::asset('lib/datatables/DataTables-1.10.23/js/jquery.dataTables.min.js') }}"></script>    
    <script src="{{ URL::asset('lib/datatables/Bootstrap-4-4.1.1/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('lib/datatables/DataTables-1.10.23/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('lib/datatables/FixedColumns-3.3.2/js/dataTables.fixedColumns.min.js') }}"></script>     

    <!-- <link href="//vjs.zencdn.net/7.10.2/video-js.min.css" rel="stylesheet">
        <script src="//vjs.zencdn.net/7.10.2/video.min.js"></script> -->

        <style type="text/css">
            .btn-primary {
                background-color: #106eb2 !important;
            }

            .btn-info {
                background-color: #fff !important;
                color: #106eb2 !important;
                border-color: #106eb2 !important;
            }

            .alert-primary {
                background-color: #106eb2 !important;
                color: #fff !important;
            }

            .alert .ml-3 i {
                vertical-align: middle;
            }

            .invalid-feedback {
                text-transform: capitalize !important;
            }
        </style>

        <title>E-PMII Malang</title>
    </head>
    <body style="margin: 0">
        <div class="mt-5">            
            @yield('content')
        </div>    
        <!--===== MAIN JS =====-->
        <script src="{{ URL::asset('assets/js/main_slider.js') }}"></script>        
    </body>
    </html>