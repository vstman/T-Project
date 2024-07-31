@foreach($posts as $post)
    <div class="col-md-3 mb-5">
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