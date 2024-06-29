@extends('projectPanel.layout.app')

@section('content')
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<div id="test">
    @foreach($posts as $post)
        {{$post->title}}
        ---
        {!!$post->content!!}
        ---
        @auth
        <a >
            <button class="btn-warning" name="btn">Düzenle</button>
        </a><br>
        @endauth
        <br>
        <hr>    
    @endforeach
        <hr>
    @auth
    <a href="{{route('admin.posts.create')}}">
        <button class="btn-success">Ekle</button>
    </a>
    @endauth
</div>
  

@endsection
