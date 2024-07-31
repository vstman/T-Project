@extends('projectPanel.layout.app')

@section('style-content')
    <style>
        .card-body {
            display: flex;
            justify-content: center;
            align-items: center; /* Center the content vertically */
        }

        .card-body .title {
            margin: 0; /* Remove margin between title and icon */
            padding: 0 15px; /* Add padding between title and edges */
            flex: 1; /* Ensure title takes up remaining space */
            text-align: left; /* Align title to the left */
        }

        .card-body .icon {
            font-size: 1.5rem; /* Adjust icon size */
            margin-left: auto; /* Push icon to the right */
        }
        .special-content {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 860px;
        }

        @media screen and (max-width: 770px) {
            .special-content {
                height: 100%;
            }
        }
    </style>
@endsection

@section('content')
    <div class="special-content">
        <div class="row mt-5">
            <h1 class="col-12 mb-5 mt-2">Projelerimiz</h1>
            @foreach($posts as $post)
                <div class="col-md-3 mb-3">
                    <a href="{{ route('posts.details', $post->id) }}" class="card-link">
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
        <div class="row mt-auto">
            <div class="col-md-12 d-flex">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
