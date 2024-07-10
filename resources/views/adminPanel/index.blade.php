@extends('adminPanel.layout.app')

@section('content')


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <title>Admin Index</title>
</head>
<body>
<table id="example" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th>Başlık</th>
            <th>İçerik</th>
            <th>Yayın Tarihi</th>
            <th>İşlemler</th>
        </tr>
    </thead>
    <tbody>
        @foreach($posts as $post)
        <tr>
            <td>{{ $post->title }}</td>
            <td>{!! Str::limit(strip_tags($post->content), 40) !!}</td>
            <td>{{ $post->created_at->format('Y-m-d') }}</td>
            <td>
                <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-primary">Düzenle</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script defer src="//cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
<script>
    $(document).ready(function (){
        $('#example').DataTable({
            "columnDefs": [
                { "orderable": false, "targets": 3 } // Disable sorting on the 'Edit' column
            ]
        });
    });
</script>
</body>
</html>
