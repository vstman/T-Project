<!DOCTYPE html>
<html lang="en">
<head>
    <title>Projelerimiz - Admin</title>
    <link rel="icon" type="image/x-icon" href="{{asset('projectPanel/assets/favicon.ico')}}"/>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- CSS Files -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <link rel="stylesheet" href="{{asset('adminPanel/assets/css/kaiadmin.min.css')}}"/>

    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>
<body>
<div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar" data-background-color="dark">
        <div class="sidebar-logo">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="dark">
                <a href="{{route('admin.index')}}" class="logo">
                    <img
                        src="{{asset('adminPanel/assets/img/test.webp')}}"
                        alt="navbar brand"
                        class="navbar-brand"
                        height="20"
                    />
                </a>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                        <i class="gg-menu-right"></i>
                    </button>
                    <button class="btn btn-toggle sidenav-toggler">
                        <i class="gg-menu-left"></i>
                    </button>
                </div>
            </div>
            <!-- End Logo Header -->
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
            <div class="sidebar-content">
                <ul class="nav nav-secondary">
                    <li class="nav-item submenu">
                        <a
                            data-bs-toggle="collapse"
                            class="collapsed"
                            aria-expanded="false"
                        >
                            <i class="fas fa-user"></i>
                            <p>Hoşgeldin, Kullanıcı</p>
                        </a>
                    </li>
                    <br>
                    <li class="nav-item submenu">
                        <a
                            data-bs-toggle="collapse"
                            href="#collapseExample"
                            class="collapsed"
                            aria-expanded="false"
                        >
                            <i class="fas fa-project-diagram"></i>
                            <p>Projeler</p>
                        </a>
                        <div id="collapseExample" class="collapse">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="{{ route('admin.posts.create') }}">Yeni Proje Ekle</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.index') }}">Projeleri Yönet</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <br>
                    <li class="nav-item submenu">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           class="collapsed" aria-expanded="false">
                            <i class="fas fa-sign-out-alt"></i>
                            <p>Çıkış Yap</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Sidebar -->

    <div class="main-panel">
        <div class="main-header">
            <div class="main-header-logo">
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="dark">
                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="gg-menu-right"></i>
                        </button>
                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="gg-menu-left"></i>
                        </button>
                    </div>
                </div>
                <!-- End Logo Header -->
            </div>
        </div>

        <div class="container">
            <div class="page-inner">
                @yield('content')
            </div>
        </div>
    </div>
</div>
<!--   Core JS Files   -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js"></script>
<!--   Core JS Files   -->
<script src="{{asset('adminPanel/assets/js/core/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('adminPanel/assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('adminPanel/assets/js/core/bootstrap.min.js')}}"></script>

<!-- jQuery Scrollbar -->
<script src="{{asset('adminPanel/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>

<!-- Chart JS -->
<script src="{{asset('adminPanel/assets/js/plugin/chart.js/chart.min.js')}}"></script>

<!-- jQuery Sparkline -->
<script src="{{asset('adminPanel/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js')}}"></script>

<!-- Datatables -->
<script src="{{asset('adminPanel/assets/js/plugin/datatables/datatables.min.js')}}"></script>

<!-- Bootstrap Notify -->
<script src="{{asset('adminPanel/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>

<!-- jQuery Vector Maps -->
<script src="{{asset('adminPanel/assets/js/plugin/jsvectormap/jsvectormap.min.js')}}"></script>
<script src="{{asset('adminPanel/assets/js/plugin/jsvectormap/world.js')}}"></script>

<!-- Sweet Alert -->
<script src="{{asset('adminPanel/assets/js/plugin/sweetalert/sweetalert.min.js')}}"></script>

<script src="{{asset('adminPanel/assets/js/kaiadmin.min.js')}}"></script>

<script src="{{asset('adminPanel/assets/js/setting-demo.js')}}"></script>
<script src="{{asset('adminPanel/assets/js/demo.js')}}"></script>
<script>
    // Sidebar toggle for small screens
    $(document).ready(function () {
        $('.toggle-sidebar').on('click', function () {
            $('.sidebar').toggleClass('active');
        });

        $('.topbar-toggler').on('click', function () {
            $('.sidebar').toggleClass('active');
        });

        // Dropdown menu toggle for small screens
        $('.dropdown-toggle').dropdown();
    });
</script>

</body>
</html>
