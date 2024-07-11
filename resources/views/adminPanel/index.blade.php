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
                            <a href="{{ route('admin.admin_details', $post->id) }}" class="btn btn-primary">Detay</a>
                            <button class="btn btn-danger" onclick="confirmDeletion('{{ route('admin.posts.destroy', $post->id) }}')">Sil</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script defer src="//cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                "columnDefs": [
                    {"orderable": false, "targets": 3} // Disable sorting on the 'Edit' and 'Delete' columns
                ]
            });
        });

        function confirmDeletion(url) {
            Swal.fire({
                title: 'Bu öğeyi silmek istediğinize emin misiniz?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Evet, sil!',
                cancelButtonText: 'Hayır'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(result) {
                            Swal.fire(
                                'Silindi!',
                                'Öğe başarıyla silindi.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        },
                        error: function(result) {
                            Swal.fire(
                                'Hata!',
                                'Öğe silinirken bir hata oluştu.',
                                'error'
                            );
                        }
                    });
                }
            })
        }
    </script>

@endsection
