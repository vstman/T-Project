@extends('adminPanel.layout.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <h2>Projeler</h2>
            <a href="{{ route('admin.posts.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Ekle
            </a>
        </div>

        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Başlık</th>
                    <th>İçerik</th>
                    <th>Yayın Tarihi</th>
                    <th>İşlemler</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{!! Str::limit(strip_tags($post->content), 40) !!}</td>
                        <td>{{ $post->created_at->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-primary">Düzenle</a>
                            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Sil</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script defer src="//cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                "columnDefs": [
                    {"orderable": false, "targets": 3} // Disable sorting on the 'Edit' column
                ]
            });
        });
    </script>

@endsection
