@extends('projectPanel.layout.app')

@section('content')
        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-3">
                    <div class="card mb-3">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{$post->title}}</h5>
                            <p class="card-text">{!! $post->content !!}</p>
                            @auth
                                <a href="{{ route('admin.posts.edit', $post->id) }}" class="mt-auto ml-auto">
                                    <button class="btn btn-warning btn-sm">Düzenle</button>
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
@endsection

@section('footer-top')
    <div class="container">
        <div class="col-md-12 d-flex justify-content-between" style="padding-bottom: 0">
            @auth
                <div>
                    <a href="{{ route('admin.posts.create') }}" class="btn btn-success">Ekle</a>
                </div>
            @endauth
            <div>
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
