@extends('projectPanel.layout.app')

@section('content')
    <div style="margin-top: 50px;">
    <a href="{{ route('posts.main') }}" class="btn btn-warning">
        <i class="fas fa-arrow-left"></i> Geri
    </a>
    <br>
    <br>

    @if($posts->isEmpty())
        <div class="alert alert-info" role="alert">
            <strong>Bulunamadı!</strong> Aradığınız kriterlere uygun sonuç bulunamadı.
        </div>
    @else
        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-3">
                    <div class="card mb-3">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{$post->project_title}}</h5>
                            <p class="card-text">{!! Str::limit(strip_tags($post->content), 40) !!}</p>
                        </div>
                        <a href="{{ route('posts.details', $post->id) }}" class="mt-auto ml-auto">
                            <button class="btn btn-warning btn-sm">Detay</button>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    </div>
    <div class="container">
        <div class="col-md-12 d-flex justify-content-between">
            <div>
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
