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
                <td colspan="2"><p id="project-title">{{ $post->project_title }} - {{ $post->project_code }}</p></td>

            </tr>
            <tr>
                <td><label for="supervisor" class="col-form-label">Yürütücü:</label></td>
                <td>
                    <div class="d-flex flex-column">
                        <div class="d-flex align-items-center mb-2">
                            <img id="supervisor-photo" src="{{ asset('path/to/default/image.png') }}" alt="Supervisor Photo" class="img-thumbnail mr-2" width="100" height="100">
                        </div>
                        <p id="supervisor">{{ $post->supervisor }}</p>
                    </div>
                </td>
                <td><p id="department">{{ $post->department }}</p></td>
            </tr>

            @if ($post->teamMembers->isNotEmpty())

                <tr class="team-template">
                    <td rowspan="{{ $post->teamMembers->count() }}">
                        <label for="team" class="col-form-label">Proje Ekibi:</label>
                    </td>
                @foreach ($post->teamMembers as $teamMember)
                    <td colspan="1">
                        <div class="row">

                                <p >{{ $teamMember->name }},

                              {{ $teamMember->position }}</p>

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
        <button class="btn btn-danger" onclick="confirmDeletion('{{ route('admin.posts.destroy', $post->id) }}')">Sil</button>
    </div>

@endsection
