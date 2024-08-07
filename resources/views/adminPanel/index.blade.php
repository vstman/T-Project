@extends('adminPanel.layout.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <h2>Projeler</h2>
            <a href="{{ route('admin.posts.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Ekle
            </a>
        </div>

        <div class="table-responsive">
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                <tr>
                    <th>Destekleyen Kurum</th>
                    <th>Başlık</th>
                    <th>Kod</th>
                    <th>Yürüten</th>
                    <th>Departman</th>
                    <th>Proje Süresi</th>
                    <th>Bütçe</th>
                    <th>İşlemler</th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->supporting_organization }}</td>
                        <td>{{ $post->project_title }}</td>
                        <td>{{ $post->project_code }}</td>
                        <td>{{ $post->supervisors->first()->name}}</td>
                        <td>{{ $post->supervisors->first()->department}}</td>
                        <td>{{ $post->duration }}</td>
                        <td>{{ $post->budget }}</td>
                        <td>
                            <a href="{{ route('admin.posts.edit', $post->slug) }}" class="btn btn-success">Düzenle</a>
                            <a href="{{ route('admin.admin_details', $post->slug) }}" class="btn btn-secondary">Detay</a>
                            <button class="btn btn-danger"
                                    onclick="confirmDeletion('{{ route('admin.posts.destroy', $post->slug) }}')">Sil
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">

    <!-- DataTables JS -->
    <script defer src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                language: {
                    url: '{{ asset('/lang/tr.json') }}', // Dil dosyasının yolunu doğru bir şekilde belirtin
                },
                columnDefs: [
                    { orderable: false, targets: 7 } // 'İşlemler' sütununda sıralamayı devre dışı bırak
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
                        success: function (result) {
                            Swal.fire(
                                'Silindi!',
                                'Öğe başarıyla silindi.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        },
                        error: function (result) {
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
