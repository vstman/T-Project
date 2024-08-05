@extends('adminPanel.layout.app')

@section('content')
    <div class="container">
        <a href="{{ route('admin.index') }}" class="btn btn-warning">
            <i class="fas fa-arrow-left"></i> Geri
        </a>
        <br><br>
        <form id="post-form" action="{{ route('admin.posts.update', ['id' => $post->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <table class="table table-bordered">
                <tbody id="project-table-body">
                <tr>
                    <td><label for="supporting-organization" class="col-form-label">Proje Destekleyen Kurum:</label></td>
                    <td colspan="2"><input type="text" class="form-control" id="supporting-organization" name="supporting_organization" value="{{ old('supporting_organization', $post->supporting_organization) }}" aria-label="Proje Destekleyen Kurum" required></td>
                </tr>
                <tr>
                    <td><label for="project-title" class="col-form-label">Proje Adı ve Kodu:</label></td>
                    <td><input class="form-control" id="project-title" name="project_title" placeholder="Proje Adı" value="{{ old('project_title', $post->project_title) }}" aria-label="Proje Adı" required></td>
                    <td><input class="form-control" id="project-code" name="project_code" placeholder="Kodu" value="{{ old('project_code', $post->project_code) }}" aria-label="Proje Kodu" required></td>
                </tr>

                <!-- Supervisors Section -->
                @foreach ($post->supervisors as $index => $supervisor)
                    <tr class="supervisor-template">
                        @if ($index == 0)
                            <td rowspan="{{ $post->supervisors->count() }}" id="supervisors-rowspan">
                                <label for="supervisor" class="col-form-label">Yürütücü(ler):</label>
                            </td>
                        @endif
                        <td colspan="1">
                            <div class="row">
                                <div class="col">
                                    <input type="hidden" name="supervisor_id[{{ $index }}]" value="{{ $supervisor->id }}">
                                    <input class="form-control" name="supervisor_name[{{ $index }}]" placeholder="Unvan Ad Soyad" value="{{ old('supervisor_name.' . $index, $supervisor->name) }}" aria-label="Yürütücü Ad Soyad" required>
                                </div>
                                <div class="col">
                                    <input class="form-control" name="supervisor_department[{{ $index }}]" placeholder="Bölüm" value="{{ old('supervisor_department.' . $index, $supervisor->department) }}" aria-label="Yürütücü Bölüm" required>
                                </div>
                            </div>
                        </td>
                        <td>
                            <input class="form-control-file" type="file" name="supervisor_photo[{{ $index }}]" onchange="previewImage(event, {{ $index }})">
                            @if ($supervisor->supervisor_photo)
                                <img src="{{ asset($supervisor->supervisor_photo) }}" class="supervisor-photo" alt="Supervisor Photo" style="max-width: 200px;height: 200px; margin-top: 10px;">
                            @else
                                <img src="{{ asset('storage/default-photo.png') }}" class="supervisor-photo" alt="Default Photo" style="max-width: 200px;height: 200px; margin-top: 10px;">
                            @endif
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4">
                        <button type="button" class="btn btn-primary btn-sm" id="add-supervisor">
                            <i class="fa-solid fa-plus"></i> Yürütücü Ekle
                        </button>
                    </td>
                </tr>

                <!-- Team Members Section -->
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
                                    <input type="hidden" name="team_member_id[{{ $index }}]" value="{{ $teamMember->id }}">
                                    <input class="form-control" name="team_name[{{ $index }}]" placeholder="Ad Soyad" value="{{ old('team_name.' . $index, $teamMember->name) }}" aria-label="Ekip Üyesi Ad Soyad" required>
                                </div>
                                <div class="col">
                                    <input class="form-control" name="team_position[{{ $index }}]" placeholder="Görevi" value="{{ old('team_position.' . $index, $teamMember->position) }}" aria-label="Ekip Üyesi Görevi" required>
                                </div>
                            </div>
                        </td>
                        <td><input class="form-control" name="team_department[{{ $index }}]" placeholder="Üniversite Bölüm" value="{{ old('team_department.' . $index, $teamMember->department) }}" aria-label="Ekip Üyesi Bölüm" required></td>
                    </tr>
                @endforeach

                <tr>
                    <td colspan="4">
                        <button type="button" class="btn btn-primary btn-sm" id="add-team-member">
                            <i class="fa-solid fa-plus"></i> Ekip Üyesi Ekle
                        </button>
                    </td>
                </tr>

                <tr>
                    <td><label for="duration" class="col-form-label">Proje Süresi (Ay):</label></td>
                    <td colspan="2"><input type="text" class="form-control" id="duration" name="duration" value="{{ old('duration', $post->duration) }}" aria-label="Proje Süresi (Ay)" required></td>
                </tr>
                <tr>
                    <td><label for="budget" class="col-form-label">Proje Bütçesi (TL):</label></td>
                    <td colspan="2"><input type="text" class="form-control" id="budget" name="budget" value="{{ old('budget', $post->budget) }}" aria-label="Proje Bütçesi (TL)" required></td>
                </tr>
                </tbody>
            </table>
            <button type="submit" class="btn btn-success">Güncelle</button>
        </form>
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    </div>

    <script>
        document.getElementById('add-supervisor').addEventListener('click', function() {
            var templateRow = document.querySelector('.supervisor-template').cloneNode(true);
            templateRow.classList.remove('supervisor-template');
            templateRow.querySelectorAll('input').forEach(input => input.value = '');

            // Reset image
            templateRow.querySelector('img.supervisor-photo').src = '';

            var newIndex = document.querySelectorAll('.supervisor-template').length;
            var supervisorsRowspan = document.getElementById('supervisors-rowspan');
            supervisorsRowspan.rowSpan = parseInt(supervisorsRowspan.rowSpan) + 1;

            var labelCell = templateRow.querySelector('td:first-child');
            if (labelCell) {
                labelCell.remove();
            }

            templateRow.querySelectorAll('input').forEach(function(input) {
                input.name = input.name.replace(/\[\d+\]/, '[' + newIndex + ']');
            });

            document.getElementById('project-table-body').insertBefore(templateRow, this.closest('tr'));
        });

        document.getElementById('add-team-member').addEventListener('click', function() {
            var templateRow = document.querySelector('.team-template').cloneNode(true);
            templateRow.classList.remove('team-template');
            templateRow.querySelectorAll('input').forEach(input => input.value = '');

            var newIndex = document.querySelectorAll('.team-template').length;
            var teamMembersRowspan = document.getElementById('team-members-rowspan');
            teamMembersRowspan.rowSpan = parseInt(teamMembersRowspan.rowSpan) + 1;

            var labelCell = templateRow.querySelector('td:first-child');
            if (labelCell) {
                labelCell.remove();
            }

            templateRow.querySelectorAll('input').forEach(function(input) {
                input.name = input.name.replace(/\[\d+\]/, '[' + newIndex + ']');
            });

            document.getElementById('project-table-body').insertBefore(templateRow, this.closest('tr'));
        });

        function previewImage(event, index) {
            var input = event.target;
            var reader = new FileReader();

            reader.onload = function() {
                var dataURL = reader.result;
                var output = input.closest('tr').querySelector('img.supervisor-photo');
                if (output) {
                    output.src = dataURL;
                }
            };

            reader.readAsDataURL(input.files[0]);
        }

        document.getElementById('post-form').addEventListener('submit', function(event) {
            var formIsValid = true;

            document.querySelectorAll('#post-form input[required]').forEach(function(input) {
                if (!input.value) {
                    formIsValid = false;
                    input.classList.add('is-invalid');
                } else {
                    input.classList.remove('is-invalid');
                }
            });

            if (!formIsValid) {
                event.preventDefault();
                alert('Lütfen tüm zorunlu alanları doldurun.');
            }
        });
    </script>
@endsection
