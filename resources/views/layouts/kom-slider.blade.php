<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-PMII Kota Malang</title>
    <!-- core:css -->
    <link rel="stylesheet" href="{{ URL::asset('/assets/vendors/core/core.css') }}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{ URL::asset('/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <script src="{{ URL::asset('/lib/jquery/jquery.min.js') }}"></script> 
    <!-- end plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ URL::asset('/assets/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <!-- endinject -->
    <!-- Layout styles -->  
    <link rel="stylesheet" href="{{ URL::asset('/assets/css/demo_1/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="landing/img/favicon1.png" type="image/png">

    <script src="{{ URL::asset('/assets/vendors/datatables.net/jquery.dataTables.js') }}" defer></script>
    <script src="{{ URL::asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script> 
</head>
<body>
    <div class="main-wrapper">

        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar">
            <div class="sidebar-header">
                <a href="#" class="sidebar-brand">
                    E-PMII <span>Malang</span>
                </a>
                <div class="sidebar-toggler not-active">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <div class="sidebar-body">
                <ul class="nav">
                    <li class="nav-item nav-category">Main</li>
                    <li class="nav-item">
                        <a href="/home" class="nav-link">
                            <i class="link-icon" data-feather="box"></i>
                            <span class="link-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item nav-category">Pendataan</li>
                    <li class="nav-item">
                        <a href="/admin-komisariat/kader" class="nav-link">
                            <i class="link-icon" data-feather="user"></i>
                            <span class="link-title">Kader</span>
                        </a>
                    </li>
                    <li class="nav-item nav-category">Postingan</li>
                    <li class="nav-item">
                        <a href="/admin-komisariat/postingan" class="nav-link">
                            <i class="link-icon" data-feather="book"></i>
                            <span class="link-title">Postingan</span>
                        </a>
                    </li>
                    <li class="nav-item nav-category">Data Rayon</li>
                    <li class="nav-item">
                        <a href="/admin-komisariat/rayon" class="nav-link">
                            <i class="link-icon" data-feather="home"></i>
                            <span class="link-title">Rayon</span>
                        </a>
                    </li>
                    <li class="nav-item nav-category">Logout</li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="link-icon" data-feather="log-out"></i>
                            <span class="link-title">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- partial -->

        <div class="page-wrapper">

            <!-- partial:partials/_navbar.html -->
            <nav class="navbar">
                <a href="#" class="sidebar-toggler">
                    <i data-feather="menu"></i>
                </a>
                <div class="navbar-content">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown nav-profile">
                            <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @php
                                $profile = \App\Profile::where(['id_user' => Auth::user()->id])->first()->foto_terbaru;
                                @endphp
                                <img src="{{ $profile }}" alt="profile">
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- partial -->

            <div class="page-content">
                <div class="card">
                    <div class="card-body">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- core:js -->
    <script src="{{ URL::asset('/assets/vendors/core/core.js') }}"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <script src="{{ URL::asset('/assets/vendors/chartjs/Chart.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/vendors/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ URL::asset('/assets/vendors/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ URL::asset('/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/vendors/progressbar.js/progressbar.min.js') }}"></script>
    <!-- end plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ URL::asset('/assets/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/template.js') }}"></script>
    <!-- endinject -->
    <!-- custom js for this page -->
    <script src="{{ URL::asset('/assets/js/dashboard.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/datepicker.js') }}"></script>
    <!-- end custom js for this page -->
</body>
</html>    
