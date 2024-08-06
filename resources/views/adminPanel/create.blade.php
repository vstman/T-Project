@extends('adminPanel.layout.app')

@section('content')
    <a href="{{ route('admin.index') }}" class="btn btn-warning">
        <i class="fas fa-arrow-left"></i> Geri
    </a>
    <br><br>

    <form id="post-form" action="{{ route('admin.posts.addpost') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <table class="table table-bordered">
            <tbody id="project-table-body">
                <tr>
                    <td><label for="supporting-organization" class="col-form-label">Proje Destekleyen Kurum:</label></td>
                    <td colspan="2"><input type="text" class="form-control" id="supporting-organization" name="supporting_organization" required></td>
                </tr>
                <tr>
                    <td><label for="project-title" class="col-form-label">Proje Adı ve Kodu:</label></td>
                    <td><input class="form-control" id="project-title" name="project_title" placeholder="Proje Adı" required></td>
                    <td><input class="form-control" id="project-code" name="project_code" placeholder="Kodu" required></td>
                </tr>

                <tr class="supervisor-template">
                    <td><label for="supervisor" class="col-form-label">Yürütücü:</label></td>
                    <td colspan="2">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center mb-2">
                                <img class="img-thumbnail mr-2 fixed-size supervisor-photo-preview" width="100" height="100">
                                <input type="file" class="form-control-file" name="supervisor_photo[]" accept="image/*" onchange="previewImage(event, this)" required>
                            </div>
                            <input type="text" class="form-control mb-2" name="supervisor_name[]" placeholder="Unvan Ad Soyad" required>
                            <input type="text" class="form-control" name="supervisor_department[]" placeholder="Yürütücü Bölüm" required></input>
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
                    <td><label for="team" class="col-form-label">Proje Ekibi:</label></td>
                    <td colspan="1">
                        <div class="row">
                            <div class="col">
                                <input class="form-control" name="team_name[]" placeholder="Ad Soyad" required>
                            </div>
                            <div class="col">
                                <input class="form-control" name="team_position[]" placeholder="Görevi" required>
                            </div>
                        </div>
                    </td>
                    <td><input class="form-control" name="team_department[]" placeholder="Üniversite Bölüm" required></td>
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
                    <td colspan="2"><input type="text" class="form-control" id="duration" name="duration" required></td>
                </tr>
                <tr>
                    <td><label for="budget" class="col-form-label">Proje Bütçesi:</label></td>
                    <td colspan="2"><input type="text" class="form-control" id="budget" name="budget" required></td>
                </tr>
            </tbody>
        </table>
        <button type="submit" class="btn btn-success">Gönder</button>
    </form>

    <script>
        // Add Supervisor Row
        document.getElementById('add-supervisor').addEventListener('click', function() {
            var templateRow = document.querySelector('.supervisor-template').cloneNode(true);
            templateRow.classList.remove('supervisor-template');
            templateRow.querySelector('.supervisor-photo-preview').src = '';
            templateRow.querySelector('input[name="supervisor_name[]"]').value = '';
            templateRow.querySelector('input[name="supervisor_department[]"]').value = '';
            templateRow.querySelector('input[name="supervisor_photo[]"]').value = '';
            document.getElementById('project-table-body').insertBefore(templateRow, this.closest('tr'));
        });

        // Add Team Member Row
        document.getElementById('add-team-member').addEventListener('click', function() {
            var templateRow = document.querySelector('.team-template').cloneNode(true);
            templateRow.classList.remove('team-template');
            templateRow.querySelector('input[name="team_name[]"]').value = '';
            templateRow.querySelector('input[name="team_position[]"]').value = '';
            templateRow.querySelector('input[name="team_department[]"]').value = '';
            document.getElementById('project-table-body').insertBefore(templateRow, this.closest('tr'));
        });

        // Preview Image
        function previewImage(event, inputElement) {
            var reader = new FileReader();
            reader.onload = function(){
                var dataURL = reader.result;
                var output = inputElement.closest('div').querySelector('.supervisor-photo-preview');
                output.src = dataURL;
            };
            reader.readAsDataURL(inputElement.files[0]);
        }

        // Form Validation
        document.getElementById('post-form').addEventListener('submit', function(event) {
            var isValid = true;

            document.querySelectorAll('#post-form [required]').forEach(function(input) {
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
@endsection
