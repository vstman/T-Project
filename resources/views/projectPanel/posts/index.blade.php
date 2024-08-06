@extends('projectPanel.layout.app')

@section('style-content')
    <style>
        @media screen and (max-width: 767px) {
            .row {
                margin-top: 86px !important;
            }
        }

        .card-body {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card-body .title {
            margin: 0;
            padding: 0 15px;
            flex: 1;
            text-align: left;
        }

        .card-body .icon {
            font-size: 1.5rem;
            margin-left: auto;
        }
        .special-content{
            height: 840px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        @media screen and (max-width: 767px) {
            .special-content{
                height: 100%;
            }
        }
    </style>
@endsection

@section('content')
    <div class="special-content">
        <div class="row" style="margin-top: 50px;">
            <h1 class="col-12 mb-5">Projelerimiz</h1>
            <div id="results" class="row">
                @foreach($posts as $post)
                    <div class="col-md-3 mb-2">
                        <a href="{{ route('posts.details', $post->uuid) }}" class="card-link">
                            <div class="card mb-3 special-card">
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex justify-content-between align-items-center w-100">
                                        <h5 class="card-title title">
                                            {{ Str::limit($post->supporting_organization, 30) }} -
                                            {{ Str::limit($post->project_title, 30) }}
                                        </h5>
                                        <i class="fa-solid fa-arrow-right icon"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 d-flex">
                <div>
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script type="text/javascript">
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    </script>

    <script>
        $(document).ready(function () {
            $('#search').on('keyup', function() {
                var value = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('posts.search') }}",
                    data: { search: value },
                    success: function (data) {
                        $('#results').html(data.html); // Inject the returned HTML
                    }
                });
            });
        });
    </script>
@endsection
