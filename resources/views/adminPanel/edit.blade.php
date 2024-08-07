@extends('adminPanel.layout.app')
@section('style-content')
    <style>
        .alert {
            transition: opacity 0.5s ease-out;
        }
        .dynamic-section {
            margin-bottom: 15px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <a href="{{ route('admin.index') }}" class="btn btn-warning">
            <i class="fas fa-arrow-left"></i> Geri
        </a>
        @if ($errors->any())
            <div id="error-alert" class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <br><br>
        <form id="post-form" action="{{ route('admin.posts.update', ['slug' => $post->slug]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <table class="table table-bordered">
                <tbody id="project-table-body">
                <!-- Supporting Organization and Project Details -->
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
                <tr>
                    <td colspan="4">
                        <h4>Yürütücüler</h4>
                    </td>
                </tr>
                <tbody id="supervisor-sections">
                @foreach ($post->supervisors as $index => $supervisor)
                    <tr class="supervisor-section">
                        <td>
                            <button type="button" class="btn btn-danger btn-sm delete-supervisor" data-index="{{ $index }}">
                                <i class="fas fa-trash"></i> Sil
                            </button>
                        </td>
                        <td colspan="2">
                            <div class="d-flex flex-column">
                                <div class="d-flex align-items-center mb-2">
                                    <input class="form-control-file" type="file" name="supervisor_photo[{{ $index }}]" onchange="previewImage(event, {{ $index }})">
                                    <img src="{{ asset($supervisor->supervisor_photo) }}" class="supervisor-photo" alt="Supervisor Photo" style="max-width: 200px;height: 200px; margin-top: 10px;" data-index="{{ $index }}">
                                </div>
                                <input type="hidden" name="supervisor_id[{{ $index }}]" value="{{ $supervisor->id }}">
                                <input class="form-control" name="supervisor_name[{{ $index }}]" placeholder="Unvan Ad Soyad" value="{{ old('supervisor_name.' . $index, $supervisor->name) }}" aria-label="Yürütücü Ad Soyad" required>
                                <input class="form-control" name="supervisor_department[{{ $index }}]" placeholder="Bölüm" value="{{ old('supervisor_department.' . $index, $supervisor->department) }}" aria-label="Yürütücü Bölüm" required>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tr>
                    <td colspan="4">
                        <button type="button" class="btn btn-primary btn-sm" id="add-supervisor">
                            <i class="fa-solid fa-plus"></i> Yürütücü Ekle
                        </button>
                    </td>
                </tr>

                <!-- Team Members Section -->
                <tr>
                    <td colspan="4">
                        <h4>Proje Ekibi</h4>
                    </td>
                </tr>
                <tbody id="team-member-sections">
                @foreach ($post->teamMembers as $index => $teamMember)
                    <tr class="team-member-section">
                        <td>
                            <button type="button" class="btn btn-danger btn-sm delete-team-member" data-index="{{ $index }}">
                                <i class="fas fa-trash"></i> Sil
                            </button>
                        </td>
                        <td colspan="1">
                            <div class="row">
                                <div class="col">
                                    <input type="hidden" name="team_member_id[{{ $index }}]" value="{{ $teamMember->id }}">
                                    <input class="form-control" name="team_name[{{ $index }}]" placeholder="Ad Soyad" value="{{ old('team_name.' . $index, $teamMember->name) }}" aria-label="Ekip Üyesi Ad Soyad" required>
                                </div>
                                <div class="col">
                                    <input class="form-control" name="team_position[{{ $index }}]" placeholder="Görevi" value="{{ old('team_position.' . $index, $teamMember->position) }}" aria-label="Ekip Üyesi Görevi">
                                </div>
                            </div>
                        </td>
                        <td>
                            <input class="form-control" name="team_department[{{ $index }}]" placeholder="Üniversite Bölüm" value="{{ old('team_department.' . $index, $teamMember->department) }}" aria-label="Ekip Üyesi Bölüm" required>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tr>
                    <td colspan="4">
                        <button type="button" class="btn btn-primary btn-sm" id="add-team-member">
                            <i class="fa-solid fa-plus"></i> Ekip Üyesi Ekle
                        </button>
                    </td>
                </tr>

                <!-- Project Duration and Budget -->
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
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function previewImage(event, index) {
                var input = event.target;
                var file = input.files[0];
                var reader = new FileReader();

                reader.onload = function (e) {
                    var img = document.querySelector(`img.supervisor-photo[data-index="${index}"]`);
                    if (img) {
                        img.src = e.target.result;
                    }
                };

                if (file) {
                    reader.readAsDataURL(file);
                }
            }

            function addEventListenersToDynamicElements() {
                document.querySelectorAll('.form-control-file').forEach(input => {
                    input.removeEventListener('change', handleFileChange); // Remove any previous event listener
                    input.addEventListener('change', handleFileChange);
                });
            }

            function handleFileChange(event) {
                var index = event.target.dataset.index;
                previewImage(event, index);
            }

            // Bind events to existing elements
            addEventListenersToDynamicElements();

            document.getElementById('add-supervisor').addEventListener('click', function () {
                var templateRow = document.querySelector('.supervisor-section').cloneNode(true);
                templateRow.classList.remove('supervisor-section');
                templateRow.querySelectorAll('input').forEach(input => {
                    input.value = '';
                    input.dataset.index = document.querySelectorAll('#supervisor-sections .supervisor-section').length;
                });
                templateRow.querySelector('img.supervisor-photo').src = '';
                templateRow.querySelector('img.supervisor-photo').dataset.index = document.querySelectorAll('#supervisor-sections .supervisor-section').length;

                document.getElementById('supervisor-sections').appendChild(templateRow);

                addEventListenersToDynamicElements(); // Rebind events to new elements
            });

            document.getElementById('add-team-member').addEventListener('click', function () {
                var templateRow = document.querySelector('.team-member-section').cloneNode(true);
                templateRow.classList.remove('team-member-section');
                templateRow.querySelectorAll('input').forEach(input => input.value = '');
                templateRow.querySelectorAll('input').forEach(function (input) {
                    input.name = input.name.replace(/\[\d+\]/, '[' + document.querySelectorAll('#team-member-sections .team-member-section').length + ']');
                });

                document.getElementById('team-member-sections').appendChild(templateRow);
            });

            document.addEventListener('click', function (event) {
                if (event.target.classList.contains('delete-supervisor')) {
                    event.preventDefault();
                    Swal.fire({
                        title: 'Silmek İstediğinize Emin Misiniz?',
                        text: "Bu işlem geri alınamaz!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Evet, Sil!',
                        cancelButtonText: 'Hayır, İptal Et!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            event.target.closest('tr').remove();
                        }
                    });
                }

                if (event.target.classList.contains('delete-team-member')) {
                    event.preventDefault();
                    Swal.fire({
                        title: 'Silmek İstediğinize Emin Misiniz?',
                        text: "Bu işlem geri alınamaz!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Evet, Sil!',
                        cancelButtonText: 'Hayır, İptal Et!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            event.target.closest('tr').remove();
                        }
                    });
                }
            });
        });
    </script>

@endsection
