@extends('projectPanel.layout.app')

@section('content')

    <h2>{{$post->project_title}}</h2>
    {!! $post->supervisor !!}
    <br>
    <p>Yayinlanma Tarihi : </p>
    <p>{{ $post->created_at->format('Y-m-d') }}</p>

@endsection
