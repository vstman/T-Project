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
            <h2 style="text-align: center">Kayıt Ol</h2>
            <form action="{{ route('register.post') }}" method="POST" class="ms-auto me-auto mt-auto"
                  style="width: 500px;">
                @csrf
                <div class="mb-3">
                    <input type="text" class="form-control" name="name" required placeholder="Kullanıcı Adı">
                </div>
                <div class="mb-3">

                    <input type="email" class="form-control" name="email" placeholder="E-Posta" required>
                </div>
                <div class="mb-3">

                    <input type="password" class="form-control" name="password" placeholder="Şifre">
                </div>
                <div class="mb-3 text-center">
                    <button type="submit" class="btn btn-primary">Kaydol</button>
                </div>
            </form>
        </div>
    </div>
@endsection
