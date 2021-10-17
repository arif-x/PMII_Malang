<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- ===== BOX ICONS ===== -->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="assets/css/styles_slider.css">
    
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
<body id="body-pd">
    <header class="header shadow-sm" id="header">
        <div class="header__toggle">
            <i class='bx bx-menu' id="header-toggle"></i>
        </div>

        <div class="header__img">
            <img src="/assets/img/perfil.png" alt="">
        </div>
    </header>

    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>

                <div class="nav__logo">
                    <i class='bx bx-layer nav__logo-icon'></i>
                    <span class="nav__logo-name">E-PMII Malang</span>
                </div>


                <div class="nav__list">
                                      
                </div>
            </div>

            <a class="nav__link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class='bx bx-log-out nav__icon' ></i>
                <span class="nav__name">Logout</span>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </nav>
    </div>

    <div>
        <h1>Components</h1>
        @yield('content')
    </div>    
    <!--===== MAIN JS =====-->
    <script src="assets/js/main_slider.js"></script>    
</body>
</html>