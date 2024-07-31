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
        a{
            text-decoration: none;
        }

        .content {
            flex: 1;
        }

        .footer {
            width: 100%;
            position: relative;
            bottom: 0;

        }
        .text-white{
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
            background-color: rgb(18 ,106 ,205);
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
            border-left: solid rgb(18 ,106 ,205) 5px;
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
            background-color:rgb(18 ,106 ,205);
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
        .bi-twitter::before,.bi-facebook::before,.bi-instagram::before{
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
<footer class="footer bg-light text-white">
    <div class="container">
        <div class="row">
            <!-- Contact Information -->
            <div class="col-lg-3 text-center text-lg-start">
                <h5 class="text-uppercase mb-4"><strong>İLETİŞİM</strong></h5>
                <p>Adres: Boran Mahallesi Kırkgöz Caddesi No: 82B- (Adres Kodu:-3712025703-) Battalgazi/MALATYA</p>
                <p>Adres: İkizce Mahallesi İkizce Sokak No:100 P.K. 44900 Yeşilyurt / MALATYA</p>
                <p>Yeşilyurt Santral: 0422 504 80 00 -06</p>
                <p>Kep adresi: matu@hs01.kep.tr</p>
                <p>Santral: (0422)846 12 55</p>
                <p>(0422) 504 80 00-06</p>
                <p>Fax: 0422 846 12 25</p>
                <p>bilgi@ozal.edu.tr</p>
            </div>

            <!-- University Information -->
            <div class="col-lg-3 text-center text-lg-start">
                <h5 class="text-uppercase mb-4">Malatya Turgut Özal Üniversitesi</h5>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30490.848460074623!2d38.35205404541401!3d38.466200927256274!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40764bf28ac69bbf%3A0xaf9769e358c30948!2sMalatya+Turgut+%C3%96zal+%C3%9Cniversitesi!5e1!3m2!1str!2str!4v1556256830463!5m2!1str!2str" width="250" height="200" frameborder="0" style="border:0" allowfullscreen=""></iframe>
            </div>

            <!-- Social Media & Links -->
            <div class="col-lg-3 text-center text-lg-start">
                <h5 class="text-uppercase mb-4">Sosyal Medya</h5>
                <a href="https://www.facebook.com/malatyaturgutozaledu/" class="me-3"><i class="bi-facebook fs-3" style="font-size: 30px; color: #000;"></i></a>
                <a href="https://twitter.com/MTU_ozaledu" class="me-3"><i class="bi-twitter fs-3" style="font-size: 30px; color: #000;"></i></a>
                <a href="https://www.instagram.com/malatyaturgutozaledu/"><i class="bi-instagram fs-3" style="font-size: 30px; color: #000;"></i></a>
                <p class="mt-3"><a href="https://ozal.edu.tr/akademik-takvim/" target="_blank" rel="noopener">Akademik Takvim</a></p>
                <p><a href="http://obs.ozal.edu.tr/" target="_blank" rel="noopener">Öğrenci Portalı</a></p>
                <p><a href="http://pbs.ozal.edu.tr/" target="_blank" rel="noopener">Personel Bilgi Sistemi</a></p>
                <p><a href="http://belge.ozal.edu.tr/account/auth/login/" target="_blank" rel="noopener">EBYS</a></p>
                <p><a href="http://obs.ozal.edu.tr/oibs/login.aspx" target="_blank" rel="noopener">Öğrenci Bilgi Sistemi</a></p>
                <p><a href="https://cabim.ulakbim.gov.tr/ekual/e-veri-tabanlari/" target="_blank" rel="noopener">Veri Tabanları</a></p>
            </div>

            <!-- Logo -->
            <div class="col-lg-3 text-center text-lg-start">
                <img src="https://ozal.edu.tr/wp-content/uploads/2023/12/OZAL-2-1-317x500-1-1-317x500.png" alt="Malatya Turgut Özal Üniversitesi" class="img-fluid" style="max-width: 100%;">
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
