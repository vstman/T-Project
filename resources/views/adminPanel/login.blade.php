@extends('projectPanel.layout.app')
@section('style_content')
    <style>
        body, html {

            font-family: Arial, sans-serif;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            width: 320px;
            padding: 40px;
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
        }

        .login-box h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            background: #efefef;
        }

        .form-remember {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
        }

        .btn {
            width: 100%;
            padding: 10px;
            background-color: #7f87ff;
            border: none;
            border-radius: 4px;
            color: white;
            cursor: pointer;
            font-size: 16px;
        }

        .btn:hover {
            background-color: #6c74d8;
        }

        .forgot-link {
            color: #7f87ff;
            text-decoration: none;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }
    </style>
@endsection
@section('content')
    <div class="login-container">
        <div class="login-box">
            <h2>LOGIN</h2>
            <form action="{{route('login.post')}}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" id="email" name="email" class="form-control" required
                           placeholder="E-Posta">
                </div>
                <div class="form-group">
                    <input type="password" id="password" name="password" class="form-control" required
                           placeholder="Password">
                </div>
                <div class="form-group form-remember">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Remember me</label>
                    <a href="" class="forgot-link">Forgot?</a>
                </div>
                <button type="submit" class="btn btn-primary">LOGIN</button>
            </form>
        </div>
    </div>
@endsection
