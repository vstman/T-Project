@extends('adminPanel.layout.app')

@section('content')
    <div class="container">
        <a href="{{ route('admin.index') }}" class="btn btn-warning">
            <i class="fas fa-arrow-left"></i> Geri
        </a>
        <br>
        <br>
        <table class="table table-bordered">
            <tbody id="project-table-body">
            <tr>
                <td><label for="supporting-organization" class="col-form-label">Proje Destekleyen Kurum:</label></td>
                <td colspan="2"><p id="supporting-organization">{{ $post->supporting_organization }}</p></td>
            </tr>
            <tr>
                <td><label for="project-title" class="col-form-label">Proje Adı ve kodu:</label></td>
                <td colspan="2"><p id="project-title">{{ $post->project_title }} - {{ $post->project_code }}</p></td>
            </tr>
            @if ($post->supervisors->isNotEmpty())
                <tr>
                    <td rowspan="{{$post->supervisors->count()}}">
                        <label for="supervisors" class="col-form-label">Yürütücüler:</label>
                    </td>
                    @foreach ($post->supervisors as $supervisor)
                        <td colspan="1">
                            <div class="d-flex flex-column align-items-center">
                                <img src="{{ asset($supervisor->supervisor_photo ?? 'default.png') }}"
                                     alt="Supervisor Photo"
                                     class="img-thumbnail mr-2 fixed-size supervisor-photo-preview" width="100"
                                     height="100">
                                <div>
                                    <p><strong>Ad:</strong> {{ $supervisor->name }}</p>
                                </div>
                            </div>
                        </td>

                        <td><p><strong>Üniversite - Bölüm:</strong> {{ $supervisor->department }}</p></td>
                </tr>
                @endforeach
            @endif


            @if ($post->teamMembers->isNotEmpty())
                <tr class="team-template">
                    <td rowspan="{{ $post->teamMembers->count() }}">
                        <label for="team" class="col-form-label">Proje Ekibi:</label>
                    </td>
                    @foreach ($post->teamMembers as $teamMember)
                        <td colspan="1">
                            <div class="row">
                                <p>{{ $teamMember->name }}, {{ $teamMember->position }}</p>
                            </div>
                        </td>
                        <td><p id="team_department">{{ $teamMember->department ?? 'Belirtilmemiş' }}</p></td>
                </tr>
                @endforeach
            @endif

            <tr>
                <td><label for="duration" class="col-form-label">Proje Süresi:</label></td>
                <td colspan="2"><p id="duration">{{ $post->duration }} Ay</p></td>
            </tr>
            <tr>
                <td><label for="budget" class="col-form-label">Proje Bütçesi:</label></td>
                <td colspan="2"><p id="budget">{{ $post->budget }} TL</p></td>
            </tr>
            </tbody>
        </table>
        <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-success">Düzenle</a>
        <button class="btn btn-danger" onclick="confirmDeletion('{{ route('admin.posts.destroy', $post->id) }}')">Sil
        </button>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
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
                                window.location.href = '{{ route('admin.index') }}';
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
