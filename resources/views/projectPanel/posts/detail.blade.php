@extends('projectPanel.layout.app')

@section('content')

    <div class="container">
        <br>
        <a href="{{ route('posts.index') }}" class="btn btn-warning">
            <i class="fas fa-arrow-left"></i> Geri
        </a>
        <br>
        <br>

        <table class="table table-bordered">
            <tbody id="project-table-body">
            <tr>
                <td class="narrow-column"><label for="supporting-organization" class="col-form-label">Proje Destekleyen Kurum:</label></td>
                <td colspan="2"><p id="supporting-organization">{{ $post->supporting_organization }}</p></td>
            </tr>
            <tr>
                <td class="narrow-column"><label for="project-title" class="col-form-label">Proje Adı ve kodu:</label></td>
                <td colspan="2"><p>{{ $post->project_title }} - {{ $post->project_code }}</p></td>
            </tr>
            <tr>
                <td class="narrow-column"><label for="supervisor" class="col-form-label">Yürütücü:</label></td>
                <td>
                    <div class="d-flex flex-column">
                        <div class="d-flex align-items-center mb-2">
                            <img id="supervisor-photo" src="{{ asset($post->supervisor_photo ?? 'image.png') }}" class="img-thumbnail mr-2 fixed-size" width="100" height="100">
                        </div>
                        <p id="supervisor">{{ $post->supervisor }}</p>
                    </div>
                </td>
                <td><p id="department">{{ $post->department }}</p></td>
            </tr>

            @if ($post->teamMembers->isNotEmpty())
                <tr class="team-template">
                    <td rowspan="{{ $post->teamMembers->count() }}" class="narrow-column">
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
                <td class="narrow-column"><label for="duration" class="col-form-label">Proje Süresi:</label></td>
                <td colspan="2"><p id="duration">{{ $post->duration }} Ay</p></td>
            </tr>
            <tr>
                <td class="narrow-column"><label for="budget" class="col-form-label">Proje Bütçesi:</label></td>
                <td colspan="2"><p id="budget">{{ $post->budget }} TL</p></td>
            </tr>
            </tbody>
        </table>
    </div>

@endsection
