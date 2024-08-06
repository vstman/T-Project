@extends('projectPanel.layout.app')
@section('style_content')
@endsection
@section('content')
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
@endsection
