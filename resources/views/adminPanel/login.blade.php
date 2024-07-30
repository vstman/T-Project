@extends('projectPanel.layout.app')
@section('style_content')
    <style>

        .content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Yüksekliği tüm ekran boyu yap */
        }


        .alert {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid transparent;
            border-radius: 4px;
            position: absolute;
            bottom: 20px;
            z-index: 2;
            width: 320px;
            left: 50%;
            transform: translateX(-50%);
        }

        .alert-danger {
            color: #a94442;
            background-color: #f2dede;
            border-color: #ebccd1;
        }
    </style>
@endsection
@section('content')
    <div class="container content">
        <div class="form-container">
            @if(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            <h2 style="text-align: center">GİRİŞ</h2>
            <form action="{{ route('login.post') }}" method="POST" class="ms-auto me-auto mt-auto"
                  style="width: 500px;">
                @csrf
                <div class="mb-3">
                    <input type="text" id="email" name="email" class="form-control" required
                           placeholder="E-Posta">
                </div>
                <div class="mb-3">
                    <input type="password" id="password" name="password" class="form-control" required
                           placeholder="Şifre">
                </div>
                <div class="mb-3">
                    <a href="{{route('register')}}" class="forgot-link">Kayıt Ol</a>
                </div>
                <div class="mb-3 text-center">
                    <button type="submit" class="btn btn-primary">Giriş Yap</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var alertBox = document.querySelector('.alert');
            if (alertBox) {
                setTimeout(function () {
                    alertBox.style.display = 'none';
                }, 5000); // 5000 milisaniye (5 saniye) sonra kaybolur
            }
        });
    </script>
@endsection
