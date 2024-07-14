<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Projelerimiz</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{asset('projectPanel/assets/favicon.ico')}}"/>
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet"
          type="text/css"/>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet"
          type="text/css"/>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{asset('projectPanel/css/styles.css')}}" rel="stylesheet"/>

    @yield('style_content')

    <style>
        .footer {
            bottom: 0;
            width: 100%;
            position: fixed;
        }
    </style>
</head>
<body>
<!-- Navigation-->
<nav class="navbar navbar-light bg-light static-top fixed-top">
<form action="{{route('posts.search')}}" class="search order-lg-3 order-md-2 order-3 ml-auto">
                <input id="search-query" name="query" value="{{Request('query')}}" type="search" placeholder="Ara..." >
        </form>    
<div class="container">
        <a class="navbar-brand" href="{{route('posts.main')}}">Turgut Özal Üniversitesi</a>
    </div>
</nav>

<div class="container " style="margin-top: 80px">
    @yield('content')
</div>

<!-- Footer-->
<footer class="footer bg-light">
    <div class="container">

        <div class="row">
            <div class="col-lg-6 text-center text-lg-start">
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="#">Hakkında</a></li>
                    <li class="list-inline-item">⋅</li>
                    <li class="list-inline-item"><a href="#">İletişim</a></li>
                    <li class="list-inline-item">⋅</li>
                    <li class="list-inline-item"><a href="#">Kullanım Şartları</a></li>
                    <li class="list-inline-item">⋅</li>
                    <li class="list-inline-item"><a href="#">Gizlilik Politikası</a></li>
                </ul>
                <p class="text-muted small mb-4 mb-lg-0">&copy; Siteniz 2024. Tüm Hakları Saklıdır.</p>
            </div>
            <div class="col-lg-6 h-100 text-center text-lg-end my-auto">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item me-4">
                        <a href="#"><i class="bi-facebook fs-3"></i></a>
                    </li>
                    <li class="list-inline-item me-4">
                        <a href="#"><i class="bi-twitter fs-3"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#"><i class="bi-instagram fs-3"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="{{asset('projectPanel/js/scripts.js')}}"></script>
<script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>
</html>
