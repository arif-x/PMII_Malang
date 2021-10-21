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
    <link rel="stylesheet" href="{{ URL::asset('lib/bootstrap/css/bootstrap.min.css') }}">
    <link href="{{ asset('lib/datatables/FixedColumns-3.3.2/css/fixedColumns.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('lib/font-awesome/css/font-awesome.min.css') }}">

    <script src="{{ URL::asset('lib/datatables/jQuery-3.3.1/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ URL::asset('lib/datatables/DataTables-1.10.23/js/jquery.dataTables.min.js') }}"></script>    
    <script src="{{ URL::asset('lib/datatables/Bootstrap-4-4.1.1/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('lib/datatables/DataTables-1.10.23/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('lib/datatables/FixedColumns-3.3.2/js/dataTables.fixedColumns.min.js') }}"></script>     

    <title>E-PMII Malang</title>
</head>
<body id="body-pd">
    <header class="header shadow-sm" id="header">
        <div class="header__toggle">
            <i class='bx bx-menu' id="header-toggle"></i>
        </div>

        <div class="header__img">
            @php
            $profile = \App\Profile::where(['id_user' => Auth::user()->id])->first()->foto_terbaru;
            @endphp
            <img src="/storage/foto/{{ $profile }}" alt="">
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

                    <a href="/home" class="nav__link" id="home">
                        <i class='bx bx-grid-alt nav__icon' ></i>
                        <span class="nav__name">Dashboard</span>
                    </a>               

                    <a href="/module" class="nav__link" id="modules">
                        <i class='bx bx-book-content nav__icon' ></i>
                        <span class="nav__name">Data Modul</span>
                    </a>

                    <a href="/video" class="nav__link" id="videos">
                        <i class='bx bx-video nav__icon' ></i>
                        <span class="nav__name">Data Video</span>
                    </a>  

                    <a href="/history" class="nav__link" id="histories">
                        <i class='bx bx-history nav__icon' ></i>
                        <span class="nav__name">Histori</span>
                    </a>

                    <a href="/saved" class="nav__link" id="wlist">
                        <i class='bx bx-heart nav__icon' ></i>
                        <span class="nav__name">Disimpan</span>
                    </a> 

                    <a href="/profile" class="nav__link" id="profil">
                        <i class='bx bx-user nav__icon' ></i>
                        <span class="nav__name">Profil</span>
                    </a>                     
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
    <script src="{{ URL::asset('assets/js/main_slider.js') }}"></script>        
</body>
</html>