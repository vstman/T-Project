@extends('adminPanel.layout.app')

@section('content')
    <a href="{{ route('admin.index') }}" class="btn btn-warning">

        <i class="fas fa-arrow-left"></i> Geri
    </a>
    <br>
    <br>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>

    <style type='text/css'>
        .ck-editor__editable_inline {
            height: 350px;
        }

    </style>


<form action="{{ route('admin.posts.addpost') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <table class="table table-bordered">
        <tbody id="project-table-body">
            <tr>
                <td><label for="supporting-organization" class="col-form-label">Proje Destekleyen Kurum:</label></td>
                <td><input type="text" class="form-control" id="supporting-organization" name="supporting_organization"></td>
            </tr>
            <tr>
                <td><label for="project-title" class="col-form-label">Proje Adı ve kodu:</label></td>
                <td><input class="form-control" id="project-title" name="project_title" placeholder="Proje Adı"></td>
                <td><input class="form-control" id="project-code" name="project_code" placeholder="Kodu"></td>
            </tr>
            <tr>
                <td><label for="supervisor" class="col-form-label">Yürütücü:</label></td>
                <td>
                    <div class="d-flex flex-column">
                        <div class="d-flex align-items-center mb-2">
                            <img id="supervisor-photo" src="image.png" alt="Supervisor Photo" class="img-thumbnail mr-2" width="100" height="100">
                            <input type="file" class="form-control-file" id="photo-input" accept="image/*">
                        </div>
                        <input type="text" class="form-control mb-2" id="supervisor" name="supervisor" placeholder="Unvan Ad Soyad">
                    </div>
                </td>
                <td><textarea class="form-control" id="department" name="department" rows="2" placeholder="Yürütücü Bölüm"></textarea></td>
            </tr>
            <tr class="team-template">
                <td><label for="team" class="col-form-label">Proje Ekibi:</label></td>
                <td><input class="form-control" name="team_name[]" placeholder="Ad Soyad"></td>
                <td><input class="form-control" name="team_position[]" placeholder="Görevi"></td>
                <td><input class="form-control" name="team_department[]" placeholder="Üniversite Bölüm"></td>
            </tr>
            <tr>
                <td colspan="4"><button type="button" class="btn btn-primary" id="add-team-member">Ekip Üyesi Ekle</button></td>
            </tr>
            <tr>
                <td><label for="duration" class="col-form-label">Proje Süresi:</label></td>
                <td><input type="text" class="form-control" id="duration" name="duration"></td>
            </tr>
            <tr>
                <td><label for="budget" class="col-form-label">Proje Bütçesi:</label></td>
                <td><input type="text" class="form-control" id="budget" name="budget"></td>
            </tr>
        </tbody>
    </table>
    <button type="submit" class="btn btn-success">Gönder</button>
</form>


    
    <script>
        document.getElementById('add-team-member').addEventListener('click', function() {
        var templateRow = document.querySelector('.team-template').cloneNode(true);
        templateRow.classList.remove('team-template');
        templateRow.querySelector('input[name="team_name[]"]').value = '';
        templateRow.querySelector('input[name="team_position[]"]').value = '';
        templateRow.querySelector('input[name="team_department[]"]').value = '';
        document.getElementById('project-table-body').insertBefore(templateRow, this.closest('tr'));
    });
    </script>

@endsection
