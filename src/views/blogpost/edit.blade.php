<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
      <title>Edit blog post</title>
</head>
    <body>

      <div style="width: 500px; margin: 0 auto; margin-top: 90px;">
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

      <h3>Blog Post</h3>

      <form action="{{route('allblogpostupdate',$blogPost->id)}}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('patch')
          <div class="form-group">
            <label for="exampleFormControlInput1">Title</label>
            <input type="text" class="form-control" name="title" value="{{$blogPost->title}}" id="exampleFormControlInput" placeholder="Title">
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput1">Sub title</label>
            <input type="text" class="form-control" name="subtitle" value="{{$blogPost->subtitle}}" id="exampleFormControlInput" placeholder="Sub Title">
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput1">Featured image</label>
            <input type="file" class="form-control" name="image" />
          </div>
          @if(isset($blogPost->image))
          <div class="form-group">
            <label for="exampleFormControlInput1">Image</label><br>
          <img src={{url('/blogpost/images/'.$blogPost->image)}} width="100" height="100" alt=""/>
          </div>
          @endif

          <div class="form-group">
            <label for="exampleFormControlTextarea1">Post body</label>
            <textarea class="form-control"name="postbody" id="exampleFormControlTextarea1" rows="3">{{ $blogPost->post_body }}</textarea>
          </div>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Select category</label><br>
            @foreach ($allCategory as $item)
            {{$item->category_name}} <input type="checkbox" name="category[]" value="{{$item->id}}" {{ isset($item->selected) ? 'checked' :'' }}><br>
            @endforeach
          </div>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Meta title</label>
            <input type="text" class="form-control" name="metatitle" value="{{$blogPost->meta_title}}" id="exampleFormControlInput" placeholder="Meta Title">
          </div>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Meta description</label>
            <textarea class="form-control"name="metadescription" id="exampleFormControlTextarea1" rows="3">{{$blogPost->meta_desc}}</textarea>
          </div>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Meta tags</label>
            <input type="text" class="form-control" name="metatags" value="{{$blogPost->meta_tags}}" id="exampleFormControlInput" placeholder="Meta Tags">
          </div>
          <div class="form-group">
            <label for="sel1">Status</label>
            <select class="form-control" name="status">
              <option  selected disabled hidden>Select status</option>
              <option value="published">Published</option>
              <option value="unpublished">Unpublished</option>
              <option value="draft">Draft</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
     </form>
    </div>
    <script>
      CKEDITOR.replace('postbody');
    </script>
</body>
</html>