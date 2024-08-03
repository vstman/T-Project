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

        a {
            text-decoration: none;
        }

        .content {
            flex: 1;
        }

        .footer-content {
            width: 100%;
            position: relative;
            bottom: -17px;
            background-color: #262f5a;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px 0;

        }

        .logo {
            margin-bottom: 10px;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            margin-bottom: 10px;
        }

        .social-icons a {
            color: white!important;
            font-size: 23px;
            padding: 10px;
        }

        .copyright-text {
            background-color: rgb(18, 167, 205);
            padding: 5px 0;
            font-size: 10px;
            color: white;
            text-align: center;
            position: relative;
            bottom: -17px;
        }
        .text-white {
            color: #ffffff !important;
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
            background-color: rgb(18, 106, 205);
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
            border-left: solid rgb(18, 106, 205) 5px;
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
            background-color: rgb(18, 106, 205);
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

        .footer.text-white a {
            color: #ffffff !important;
        }

        .bi-twitter::before, .bi-facebook::before, .bi-instagram::before {
            color: #ffffff;
        }

    </style>

    @yield('style-content')
</head>
<body>
<!-- Navigation-->
<nav class="navbar navbar-light bg-light static-top fixed-top" style="margin-top: -37px;">
    <div class="container">
        <a class="navbar-brand" href="{{route('posts.main')}}">
            <img
                src="{{asset('projectPanel/assets/MTÜ LOGO 4.png')}}"
                alt="navbar brand"
                class="navbar-brand"
                height="50"
            /></a>
        <form action="{{route('posts.search')}}" class="search-form ml-auto">
            <input id="search" name="search" type="search" placeholder="Ara..."
                   required>
        </form>
    </div>
</nav>

<div class="content container">
    @yield('content')
</div>

<!-- Footer-->
<footer class="mb-0">
    <div class="footer-content">
        <div class="logo">
            <!--Logo-->
            <a href=""><img src="{{asset('projectPanel/assets/img.png')}}" alt="Logo"
                            style="width: 150px; height: 150px;"></a>
        </div>
        <div class="social-icons">
            <!-- Sosyal medya ikonları-->
            <a href="https://www.instagram.com/malatyaturgutozaledu/" target="_blank"><i
                    class="fa-brands fa-instagram"></i></a>
            <a href="https://twitter.com/MTU_ozaledu" target="_blank"><i
                    class="fa-brands fa-twitter"></i></a>
            <a href="" target="_blank"><i class="fa-brands fa-facebook"></i></a>
            <a href="https://www.youtube.com/channel/UC1vdFuS3OMIn5jwOIUyAdKQ" target="_blank"><i
                    class="fa-brands fa-youtube"></i></a>
            <a href="https://www.google.com/maps?q=" target="_blank">
                <i class="fa-solid fa-location-dot"></i>
            </a>
            <!-- Diğer sosyal medya ikonları -->
        </div>

    </div>
    <p class="text-center copyright-text">2024 © Fırat Üniversitesi
        <a href="https://ddyo.firat.edu.tr/tr" style="color: white">Dijital Dönüşüm ve Yazılım Ofisi</a></p>
</footer>



<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="{{asset('projectPanel/js/scripts.js')}}"></script>
<script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>
</html>
