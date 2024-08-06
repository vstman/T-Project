<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Giriş Yap</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{asset('projectPanel/assets/favicon.ico')}}"/>
    <!-- Bootstrap icons-->
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{asset('projectPanel/css/styles.css')}}" rel="stylesheet"/>

    <style>
        .container{
            height: 80vh;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
        }

    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mt-5">
                <div class="card-header">Giriş Yap</div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">E-posta</label>
                            <input type="email" id="email" class="form-control" name="email" required autofocus>
                        </div>
                        <div class="form-group mt-3">
                            <label for="password">Şifre</label>
                            <input type="password" id="password" class="form-control" name="password" required>
                        </div>
                        <div class="form-group mt-3 text-center">
                            <button type="submit" class="btn btn-primary">Giriş Yap</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
