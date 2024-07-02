@extends('projectPanel.layout.app')

@section('content')
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<div id="test" class="container">
    <div class="row">
        @foreach($posts as $post)
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{$post->title}}</h5>
                    <p class="card-text">{!! $post->content !!}</p>
                    @auth
                    <a href="" class="mt-auto ml-auto">
                        <button class="btn btn-warning btn-sm">Düzenle</button>
                    </a>
                    @endauth
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @auth
    <div class="row">
        <div class="col-12 text-center">
            <a href="{{ route('admin.posts.create') }}" class="btn btn-success mt-4">Ekle</a>
        </div>
    </div>
    @endauth
</div>
@endsection
