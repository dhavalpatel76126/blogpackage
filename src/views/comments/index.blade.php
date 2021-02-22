@section('content')
@forelse ($allComments as $comment)
<div class="card m-4" style="max-width: 500px;">
   <div class="card-body">
      <h5 class="card-title"><a href="#">{{$comment->comment}}</a><br></h5>
   </div>
   @if($comment->status == 'published')
   <button type="button" class="btn btn-success" onclick="changeCommentStatus('published','{{$comment->id}}')">Published</button>
   @else 
   <button type="button" class="btn btn-info" onclick="changeCommentStatus('unpublished','{{$comment->id}}')">UnPublished</button>
   @endif
</div>
@empty
<div class="alert alert-danger">None found, why don't you add one?</div>
@endforelse
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
   function changeCommentStatus(status,commentId) {
       $.ajax({
            type:'POST',
            data:{status:status, commentId:commentId,   "_token": "{{ csrf_token() }}",},
            url:"{{url('/admin/changeCommentStatus')}}",
            dataType: 'json',
            success:function(data){
            location.reload();
            }
       });
   }
</script>