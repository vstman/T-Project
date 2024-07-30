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
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet"
          type="text/css"/>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{asset('projectPanel/css/styles.css')}}" rel="stylesheet"/>

    @yield('style_content')

    <style>
        html, body {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        .content {
            flex: 1;
        }

        .footer {
            width: 100%;
            position: relative;
            bottom: 0;
        }

        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000; /* Ensures the navbar is above other content */
        }

        .container {
            margin-top: 42px; /* Adjust this if your navbar height changes */
        }

        .search-form {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        .search-form input[type="search"] {
            border-radius: 20px 0 0 20px;
            border: 1px solid #ced4da;
            padding: 10px;
            width: 250px;
        }

        .search-form button {
            border-radius: 0 20px 20px 0;
            border: 1px solid #ced4da;
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border-left: 0;
        }

        .search-form button:hover {
            background-color: #0056b3;
        }

        label {
            font-weight: bold;
        }

        .fixed-size {
            width: 200px;
            height: 200px;
            object-fit: cover;
        }

        .narrow-column {
            width: 200px;
            white-space: nowrap;
        }

        .special-card {
            border-left: solid #49a1ee 5px;
        }

        .special-card {
            position: relative;
            overflow: hidden;
            background-color: #ffffff; /* Kartın normal arka plan rengi */
            transition: background-color 0.3s ease;
        }

        .special-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%; /* Başlangıçta kartın dışında */
            height: 100%;
            width: 100%;
            background-color: #49a1ee;
            transition: left 0.3s ease;
            z-index: 0;
        }

        .special-card:hover::before {
            left: 0; /* Hover sırasında kartın tamamını kaplayacak şekilde sağa kaydır */
        }

        .special-card {
            position: relative;
            transition: left 0.3s ease, color 0.3s ease; /* Geçiş özelliklerini tanımlıyoruz */
            left: 0; /* Başlangıç konumu */
            height: 158px;
        }

        .special-card:hover {
            color: #ffffff;
            transform: scale(1.08);
        }
        .special-card > * {
            position: relative;
            z-index: 1;
        }

        .card-link {
            text-decoration: none;
            color: inherit;
        }

    </style>

    @yield('style-content')
</head>
<body>
<!-- Navigation-->
<nav class="navbar navbar-light bg-light static-top fixed-top" style="margin-top: -37px;">
    <div class="container">
        <a class="navbar-brand" href="{{route('posts.main')}}">Turgut Özal Üniversitesi</a>
        <form action="{{route('posts.search')}}" class="search-form ml-auto">
            <input id="search-query" name="query" value="{{Request('query')}}" type="search" placeholder="Ara..."
                   required>
            <button type="submit"><i class="bi-search"></i></button>
        </form>
    </div>
</nav>

<div class="content container" style="display: flex;flex-direction: column;justify-content: space-between;">
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
