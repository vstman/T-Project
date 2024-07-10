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


    <form action="{{ route('admin.posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Başlık</label>
            <input type="text" name="post_title" class="form-control" id="exampleFormControlInput1"
                   value="{{ $post->title }}" placeholder="Gönderi başlığını giriniz...">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">İçerik</label>
            <textarea name="post_content" class="form-control" id="post-textarea"
                      rows="3">{{ $post->content }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Güncelle</button>
    </form>

    <script>
        ClassicEditor
            .create(document.querySelector('#post-textarea'), {
                ckfinder: {
                    uploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}"
                }
            })
            .catch(error => {
                console.error(error);
            });
    </script>

@endsection
