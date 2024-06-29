@extends('projectPanel.layout.app')

@section('content')

<head>  
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>

<style type='text/css'> 
    .ck-editor__editable_inline
    {
        height:350px;
    }

</style>
</head>

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
<script>
    ClassicEditor
        .create(document.querySelector('#post-textarea'),
        {
            ckfinder:
            {
                uploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}"

            }
        })
        .catch( error =>{
        consolo.error(error);
        });
</script>

@endsection