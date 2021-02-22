
@section('content')
    @forelse ($categories as $category)
        <div class="card m-4" style="max-width: 500px;">
            <div class="card-body">
                <h5 class="card-title"><a href="#">{{$category->category_name}}</a><br></h5>
            </div>
        </div>
    @empty
        <div class="alert alert-danger">None found, why don't you add one?</div>
@endforelse
