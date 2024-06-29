@extends('projectPanel.layout.app')

@section('content')
<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/42.0.0/ckeditor5.css" />
<script type="importmap">
    {
        "imports": {
            "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/42.0.0/ckeditor5.js",
            "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/42.0.0/"
        }
    }
</script>

<script type="module">
    import {
        ClassicEditor,
        Essentials,
        Bold,
        Italic,
        Font,
        Paragraph
    } from 'ckeditor5';

    ClassicEditor
        .create( document.querySelector( '#post-textarea' ), {
            plugins: [ Essentials, Bold, Italic, Font, Paragraph ],
            toolbar: {
                items: [
                    'undo', 'redo', '|', 'bold', 'italic', '|',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
                ]
            }
        } )
        .then( /* ... */ )
        .catch( /* ... */ );
</script>

<div id="editor">
    <p>Hello from CKEditor 5!</p>
</div>
<form action="{{route('posts_addpost')}}" method="POST">

        @csrf

        <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Başlık</label>
        <input type="text" name ="post_title" class="form-control" id="exampleFormControlInput1" placeholder="Gönderi başlığını giriniz...">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">İçerik</label>
            <textarea name = "post_content" class="form-control" id="post-textarea" rows="3"></textarea>
        </div>

        <button type = "submit " class="btn btn-success">Gönder</button>

    </form>
@endsection