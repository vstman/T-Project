<!DOCTYPE html>
<html lang="en">
<head>
    <title>Projelerimiz -Admin</title>
    <link rel="icon" type="image/x-icon" href="{{asset('projectPanel/assets/favicon.ico')}}"/>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- CSS Files -->
    <link rel="stylesheet" href="{{asset('adminPanel/assets/css/style.min.css')}}"/>

    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }

            .sidebar.active {
                display: block;
                position: absolute;
                width: 250px;
                z-index: 1000;
            }

            .sidenav-toggled .sidebar {
                display: block;
            }
        }
    </style>
</head>
<body>
<div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar" data-background-color="dark">
        <div class="sidebar-logo">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="dark">
                <a href="#" class="logo">
                    <img src="#" alt="navbar brand" class="navbar-brand" height="20"/>
                </a>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
                <button class="topbar-toggler more">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
            </div>
            <!-- End Logo Header -->
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
            <div class="sidebar-content">
                <ul class="nav nav-secondary">
                    <li class="nav-item active">
                        <a data-bs-toggle="collapse" class="collapsed" aria-expanded="false">
                            <i class="fa-solid fa-list-check"></i>
                            <p>Projeler</p>
                        </a>
                    </li>
                    <li class="nav-section">
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Sidebar -->

    <div class="main-panel">
        <div class="main-header">
            <!-- Navbar Header -->
            <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                <div class="container-fluid">
                    <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                        <li class="nav-item topbar-user dropdown hidden-caret">
                            <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#"
                               aria-expanded="false">
                                <div class="avatar-sm">
                                    <img src="{{asset('adminPanel/assets/img/profile.jpg')}}" alt="..."
                                         class="avatar-img rounded-circle"/>
                                </div>
                                <span class="profile-username">
                                    <span class="op-7">Merhaba,</span>
                                    <span class="fw-bold">İsim</span>
                                </span>
                            </a>
                            <ul class="dropdown-menu dropdown-user animated fadeIn">
                                <div class="dropdown-user-scroll scrollbar-outer">
                                    <li>
                                        <a class="dropdown-item" href="{{route('logout')}}">Çıkış Yap</a>
                                    </li>
                                </div>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>

        <div class="container mt-3">
            <div class="container mt-3">
                @yield('content')
            </div>

        </div>

    </div>
</div>
<!--   Core JS Files   -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js"></script>

<script>
    // Sidebar toggle for small screens
    $(document).ready(function () {
        $('.toggle-sidebar').on('click', function () {
            $('.sidebar').toggleClass('active');
        });

        $('.sidenav-toggler').on('click', function () {
            $('.sidebar').toggleClass('sidenav-toggled');
        });

        // Dropdown menu toggle for small screens
        $('.dropdown-toggle').dropdown();
    });
</script>
</body>
</html>
