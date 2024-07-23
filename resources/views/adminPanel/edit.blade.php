@extends('adminPanel.layout.app')

@section('content')
    <a href="{{ route('admin.index') }}" class="btn btn-warning">
        <i class="fas fa-arrow-left"></i> Geri
    </a>
    <br>
    <br>
    <div class="container">
        <form action="{{ route('admin.posts.update', ['id' => $post->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <table class="table table-bordered">
                <tbody id="project-table-body">
                <tr>
                    <td><label for="supporting-organization" class="col-form-label">Proje Destekleyen Kurum:</label></td>
                    <td colspan="2"><input type="text" class="form-control" id="supporting-organization" name="supporting_organization" value="{{ $post->supporting_organization }}"></td>
                </tr>
                <tr>
                    <td><label for="project-title" class="col-form-label">Proje Adı ve kodu:</label></td>
                    <td><input class="form-control" id="project-title" name="project_title" placeholder="Proje Adı" value="{{ $post->project_title }}"></td>
                    <td><input class="form-control" id="project-code" name="project_code" placeholder="Kodu" value="{{ $post->project_code }}"></td>
                </tr>
                <tr>
                    <td><label for="supervisor" class="col-form-label">Yürütücü:</label></td>
                    <td>
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center mb-2">
                                <img id="supervisor-photo" src="{{ $post->supervisor_photo_path ?? 'image.png' }}" alt="Supervisor Photo" class="img-thumbnail mr-2" width="100" height="100">
                                <input type="file" class="form-control-file" id="photo-input" accept="image/*" name="supervisor_photo">
                            </div>
                            <input type="text" class="form-control mb-2" id="supervisor" name="supervisor" placeholder="Unvan Ad Soyad" value="{{ $post->supervisor }}">
                        </div>
                    </td>
                    <td><textarea class="form-control" id="department" name="department" rows="5" placeholder="Yürütücü Bölüm">{{ $post->department }}</textarea></td>
                </tr>

                @foreach ($post->teamMembers as $index => $teamMember)
                    <tr class="team-template">
                        @if ($index == 0)
                            <td rowspan="{{ $post->teamMembers->count() }}" id="team-members-rowspan">
                                <label for="team" class="col-form-label">Proje Ekibi:</label>
                            </td>
                        @endif
                        <td colspan="1">
                            <div class="row">
                                <div class="col">
                                    <input class="form-control" name="team_name[]" placeholder="Ad Soyad" value="{{ $teamMember->name }}">
                                </div>
                                <div class="col">
                                    <input class="form-control" name="team_position[]" placeholder="Görevi" value="{{ $teamMember->position }}">
                                </div>
                            </div>
                        </td>
                        <td><input class="form-control" name="team_department[]" placeholder="Üniversite Bölüm" value="{{ $teamMember->department }}"></td>
                    </tr>
                @endforeach

                <tr>
                    <td colspan="4">
                        <button type="button" class="btn btn-primary btn-sm" id="add-team-member">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td><label for="duration" class="col-form-label">Proje Süresi(Ay):</label></td>
                    <td colspan="2"><input type="text" class="form-control" id="duration" name="duration" value="{{ $post->duration }}"></td>
                </tr>
                <tr>
                    <td><label for="budget" class="col-form-label">Proje Bütçesi(TL):</label></td>
                    <td colspan="2"><input type="text" class="form-control" id="budget" name="budget" value="{{ $post->budget }}"></td>
                </tr>
                </tbody>
            </table>
            <button type="submit" class="btn btn-success">Güncelle</button>
        </form>
    </div>

    <script>
        document.getElementById('add-team-member').addEventListener('click', function() {
            var templateRow = document.querySelector('.team-template').cloneNode(true);
            templateRow.classList.remove('team-template');
            templateRow.querySelector('input[name="team_name[]"]').value = '';
            templateRow.querySelector('input[name="team_position[]"]').value = '';
            templateRow.querySelector('input[name="team_department[]"]').value = '';

            var teamMembersRowspan = document.getElementById('team-members-rowspan');
            teamMembersRowspan.rowSpan = parseInt(teamMembersRowspan.rowSpan) + 1;

            var labelCell = templateRow.querySelector('td:first-child');
            if (labelCell) {
                labelCell.remove();
            }

            document.getElementById('project-table-body').insertBefore(templateRow, this.closest('tr'));
        });
    </script>
@endsection
