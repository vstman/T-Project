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
                <td class="narrow-column"><label for="project-title" class="col-form-label">Proje Adı ve Kodu:</label></td>
                <td colspan="2"><p>{{ $post->project_title }} - {{ $post->project_code }}</p></td>
            </tr>
            <tr>
                @if ($post->supervisors->isNotEmpty())
                    <tr>
                        <td><label for="supervisors" class="col-form-label">Yürütücüler:</label></td>
                        <td colspan="2">
                            @foreach ($post->supervisors as $supervisor)
                                <div class="d-flex align-items-center mb-2">
                                    <img src="{{ asset($supervisor->supervisor_photo ?? 'default.png') }}" alt="Supervisor Photo" class="img-thumbnail mr-2" width="100" height="100">
                                    <div>
                                        <p><strong>Ad:</strong> {{ $supervisor->name }}</p>
                                        <p><strong>Bölüm:</strong> {{ $supervisor->department }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </td>
                    </tr>
                @endif

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
                <td colspan="2"><p id="budget">{{ $post->budget }}</p></td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
