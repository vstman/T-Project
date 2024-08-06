@extends('adminPanel.layout.app')

@section('content')
    <div class="container">
        <h1>Kullanıcılar</h1>

        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Yeni Kullanıcı Ekle</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered mt-3">
            <thead>
            <tr>
                <th>Ad</th>
                <th>E-posta</th>
                <th>Rol</th> <!-- Add a column for Role -->
                <th>İşlemler</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @php
                            $role = $roles->firstWhere('id', $user->role_id);
                        @endphp
                        {{ $role ? $role->name : 'Rol Yok' }}
                    </td>
                    <td>
                        @if ($user->role_id != 1) <!-- Adjust this condition based on your logic -->
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">Güncelle</a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Sil</button>
                        </form>
                        @else
                            <span>-</span>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
