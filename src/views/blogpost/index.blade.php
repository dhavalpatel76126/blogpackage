
@section('content')
    @forelse ($blogPosts as $post)
        <div class="card m-4" style="max-width: 500px;">
            <div class="card-body">
                <h5 class="card-title"><a href="#">{{$post->title}}</a><br></h5>
            </div>
        </div>
    @empty
        <div class="alert alert-danger">None found, why don't you add one?</div>
@endforelse
