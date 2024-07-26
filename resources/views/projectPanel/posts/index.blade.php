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
            align-items: center; /* İçeriği ortalar */
        }

        .card-body .title {
            margin: 0; /* Başlık ve ikonun arası boşluğu kaldırır */
            padding: 0 15px; /* Başlık ile kenar arasına boşluk ekler */
            flex: 1; /* Başlığın kalan alanı kaplamasını sağlar */
            text-align: left; /* Başlığı sola hizalar */
        }

        .card-body .icon {
            font-size: 1.5rem; /* İkonun boyutunu ayarlayın */
            margin-left: auto; /* İkonun sağa yapışmasını sağlar */
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row" style="margin-top: 50px;">
            <h1 class="col-12">Projelerimiz</h1>
            @foreach($posts as $post)
                <div class="col-md-3 mb-4">
                    <a href="{{ route('posts.details', $post->id) }}" class="card-link">
                        <div class="card mb-3 special-card">
                            <div class="card-body d-flex flex-column">

                                <div class="d-flex justify-content-between align-items-center w-100">
                                    <h5 class="card-title title">{{$post->supporting_organization }}
                                        - {{$post->project_title}}</h5>
                                    <i class="fa-solid fa-arrow-right icon"></i>
                                </div>

                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-12 d-flex justify-content-between">
                <div>
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
