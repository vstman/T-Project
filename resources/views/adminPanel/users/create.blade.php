<!-- resources/views/admin/create-user.blade.php -->
@extends('adminPanel.layout.app')

@section('content')
    <div class="container">
        <h1>Yeni Kullanıcı Ekle</h1>

        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Ad:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="password">Şifre:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="role">Rol:</label>
                <select id="role" name="role_id" class="form-control" required>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ $role->name === 'admin' ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Kullanıcıyı Oluştur</button>
        </form>
    </div>
@endsection
