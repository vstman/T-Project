@extends('adminPanel.layout.app')

@section('content')

    <a href="{{ route('admin.index') }}" class="btn btn-warning">
        <i class="fas fa-arrow-left"></i> Geri
    </a>
    <br>
    <br>

    <div class="container">
        <table class="table table-bordered">
            <tbody id="project-table-body">
            <tr>
                <td><label for="supporting-organization" class="col-form-label">Proje Destekleyen Kurum:</label></td>
                <td colspan="2"><p id="supporting-organization">{{ $post->supporting_organization }}</p></td>
            </tr>
            <tr>
                <td><label for="project-title" class="col-form-label">Proje Adı ve kodu:</label></td>
                <td><p id="project-title">{{ $post->project_title }}</p></td>
                <td><p id="project-code">{{ $post->project_code }}</p></td>
            </tr>
            <tr>
                <td><label for="supervisor" class="col-form-label">Yürütücü:</label></td>
                <td>
                    <div class="d-flex flex-column">
                        <div class="d-flex align-items-center mb-2">
                            <img id="supervisor-photo" src="{{ asset('path/to/default/image.png') }}" alt="Supervisor Photo" class="img-thumbnail mr-2" width="100" height="100">
                            <!-- Fotoğraf yükleme işlemi burada değilse, varsayılan fotoğrafı gösterebilirsiniz -->
                        </div>
                        <p id="supervisor">{{ $post->supervisor }}</p>
                    </div>
                </td>
                <td><p id="department">{{ $post->department }}</p></td>
            </tr>
            <tr class="team-template">
                <td>
                    <label for="team" class="col-form-label">Proje Ekibi:</label>
                </td>
                <td colspan="1">
                    <div class="row">
                        @foreach ($post->teamMembers as $teamMember)
                            <div class="col">
                                <p id="team_name">{{ $teamMember->name }}</p>
                            </div>
                            <div class="col">
                                <p id="team_position">{{ $teamMember->position }}</p>
                            </div>
                        @endforeach
                    </div>
                </td>
                <td><p id="team_department">{{ $teamMember->department ?? 'Belirtilmemiş' }}</p></td>
            </tr>
            <tr>
                <td><label for="duration" class="col-form-label">Proje Süresi:</label></td>
                <td colspan="2"><p id="duration">{{ $post->duration }}</p></td>
            </tr>
            <tr>
                <td><label for="budget" class="col-form-label">Proje Bütçesi:</label></td>
                <td colspan="2"><p id="budget">{{ $post->budget }}</p></td>
            </tr>
            </tbody>
        </table>
    </div>

@endsection
