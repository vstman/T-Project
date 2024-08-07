@extends('adminPanel.layout.app')
@section('style-content')
    <style>
        .alert {
            transition: opacity 0.5s ease-out;
        }
    </style>
@endsection

@section('content')
    <a href="{{ route('admin.index') }}" class="btn btn-warning">
        <i class="fas fa-arrow-left"></i> Geri
    </a>
    <br>
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

    <form id="post-form" action="{{ route('admin.posts.addpost') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <table class="table table-bordered">
            <tbody id="project-table-body">
            <tr>
                <td><label for="supporting-organization" class="col-form-label">Proje Destekleyen Kurum:</label></td>
                <td colspan="2">
                    <input type="text" class="form-control" id="supporting-organization" name="supporting_organization"
                           value="{{ old('supporting_organization') }}" required>
                </td>
            </tr>
            <tr>
                <td><label for="project-title" class="col-form-label">Proje Adı ve Kodu:</label></td>
                <td>
                    <input class="form-control" id="project-title" name="project_title" placeholder="Proje Adı"
                           value="{{ old('project_title') }}" required>
                </td>
                <td>
                    <input class="form-control" id="project-code" name="project_code" placeholder="Kodu"
                           value="{{ old('project_code') }}" required>
                </td>
            </tr>

            <tr class="supervisor-template">
                <td>
                    <label for="supervisor" class="col-form-label">Yürütücü:</label>
                    <button type="button" class="btn btn-danger btn-sm ml-2 remove-row"
                            style="display: none;margin-bottom: 9px;margin-left: 15px;">
                        <i class="fa-solid fa-trash"></i> Sil
                    </button>
                </td>
                <td colspan="2">
                    <div class="d-flex flex-column">
                        <div class="d-flex align-items-center mb-2">
                            <img class="img-thumbnail mr-2 fixed-size supervisor-photo-preview" width="100"
                                 height="100">
                            <input type="file" class="form-control-file" name="supervisor_photo[]" accept="image/*"
                                   onchange="previewImage(event, this)">
                        </div>
                        <input type="text" class="form-control mb-2" name="supervisor_name[]"
                               placeholder="Unvan Ad Soyad" value="{{ old('supervisor_name.0') }}">
                        <input type="text" class="form-control" name="supervisor_department[]"
                               placeholder="Yürütücü Bölüm" value="{{ old('supervisor_department.0') }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <button type="button" class="btn btn-primary btn-sm" id="add-supervisor">
                        <i class="fa-solid fa-plus"></i> Yürütücü Ekle
                    </button>
                </td>
            </tr>

            <tr class="team-template">
                <td>
                    <label for="team" class="col-form-label">Proje Ekibi:</label>
                    <button type="button" class="btn btn-danger btn-sm mt-2 remove-row"
                            style="display: none;margin-bottom: 9px;margin-left: 15px;">
                        <i class="fa-solid fa-trash"></i> Sil
                    </button>
                </td>
                <td colspan="1">
                    <div class="row">
                        <div class="col">
                            <input class="form-control" name="team_name[]" placeholder="Ad Soyad" value="{{ old('team_name.0') }}" required>
                        </div>
                        <div class="col">
                            <input class="form-control" name="team_position[]" placeholder="Görevi" value="{{ old('team_position.0') }}">
                        </div>
                    </div>
                </td>
                <td>
                    <input class="form-control" name="team_department[]" placeholder="Üniversite Bölüm" value="{{ old('team_department.0') }}" required>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <button type="button" class="btn btn-primary btn-sm" id="add-team-member">
                        <i class="fa-solid fa-plus"></i> Ekip Üyesi Ekle
                    </button>
                </td>
            </tr>

            <tr>
                <td><label for="duration" class="col-form-label">Proje Süresi (Ay):</label></td>
                <td colspan="2">
                    <input type="text" class="form-control" id="duration" name="duration"
                           value="{{ old('duration') }}" required>
                </td>
            </tr>
            <tr>
                <td><label for="budget" class="col-form-label">Proje Bütçesi:</label></td>
                <td colspan="2">
                    <input type="text" class="form-control" id="budget" name="budget"
                           value="{{ old('budget') }}" required>
                </td>
            </tr>
            </tbody>
        </table>
        <button type="submit" class="btn btn-success">Gönder</button>
    </form>

    <script>
        // Add Supervisor Row
        document.getElementById('add-supervisor').addEventListener('click', function () {
            var templateRow = document.querySelector('.supervisor-template').cloneNode(true);
            templateRow.classList.remove('supervisor-template');
            templateRow.querySelector('.supervisor-photo-preview').src = '';
            templateRow.querySelector('input[name="supervisor_name[]"]').value = '';
            templateRow.querySelector('input[name="supervisor_department[]"]').value = '';
            templateRow.querySelector('input[name="supervisor_photo[]"]').value = '';
            templateRow.querySelector('.remove-row').style.display = 'inline-block'; // Show remove button
            document.getElementById('project-table-body').insertBefore(templateRow, this.closest('tr'));
        });

        // Add Team Member Row
        document.getElementById('add-team-member').addEventListener('click', function () {
            var templateRow = document.querySelector('.team-template').cloneNode(true);
            templateRow.classList.remove('team-template');
            templateRow.querySelector('input[name="team_name[]"]').value = '';
            templateRow.querySelector('input[name="team_position[]"]').value = '';
            templateRow.querySelector('input[name="team_department[]"]').value = '';
            templateRow.querySelector('.remove-row').style.display = 'inline-block'; // Show remove button
            document.getElementById('project-table-body').insertBefore(templateRow, this.closest('tr'));
        });

        // Remove Row
        document.addEventListener('click', function (event) {
            if (event.target.classList.contains('remove-row')) {
                event.target.closest('tr').remove();
            }
        });

        // Preview Image
        function previewImage(event, inputElement) {
            var reader = new FileReader();
            reader.onload = function () {
                var dataURL = reader.result;
                var output = inputElement.closest('div').querySelector('.supervisor-photo-preview');
                output.src = dataURL;
            };
            reader.readAsDataURL(inputElement.files[0]);
        }

        // Form Validation
        document.getElementById('post-form').addEventListener('submit', function (event) {
            var isValid = true;

            document.querySelectorAll('#post-form [required]').forEach(function (input) {
                if (!input.value) {
                    input.classList.add('is-invalid');
                    isValid = false;
                } else {
                    input.classList.remove('is-invalid');
                }
            });

            if (!isValid) {
                event.preventDefault(); // Prevent form submission
                alert('Lütfen gerekli tüm alanları doldurun.');
            }
        });

    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var errorAlert = document.getElementById('error-alert');
            if (errorAlert) {
                setTimeout(function () {
                    errorAlert.style.opacity = 0;
                    setTimeout(function () {
                        errorAlert.style.display = 'none';
                    }, 500); // Match the fade-out duration
                }, 5000); // Show for 5 seconds
            }
        });
    </script>
@endsection
