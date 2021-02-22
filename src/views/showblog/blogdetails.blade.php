<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

/* Add a gray background color with some padding */
body {
  font-family: Arial;
  padding: 20px;
  background: #f1f1f1;
}

/* Header/Blog Title */
.header {
  padding: 30px;
  font-size: 40px;
  text-align: center;
  background: white;
}

/* Create two unequal columns that floats next to each other */
/* Left column */
.leftcolumn {   
  float: left;
  width: 75%;
}

/* Right column */
.rightcolumn {
  float: left;
  width: 25%;
  padding-left: 20px;
}




/* Add a card effect for articles */
.card {
   background-color: white;
   padding: 20px;
   margin-top: 20px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Footer */
.footer {
  padding: 20px;
  text-align: center;
  background: #ddd;
  margin-top: 20px;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 800px) {
  .leftcolumn, .rightcolumn {   
    width: 100%;
    padding: 0;
  }
}
</style>
</head>
<body>

<div class="header">
  <h2>{{$getBlogDetails->title}}</h2>
</div>

<div class="row">
  <div class="leftcolumn">
      <div class="card">
        <h5>{{$getBlogDetails->subtitle}}, {{ \Carbon\Carbon::parse($getBlogDetails->created_at)->diffForHumans()}}</h5>
        <img src={{url('/blogpost/images/'.$getBlogDetails->image)}} style="width:100px;height:100px" alt=""/>
        <p>{!! $getBlogDetails->post_body !!}</p>
      </div>
      <form action="{{ url('addcomment').'/'.$getBlogDetails->id.'/'.$getBlogDetails->slug }}" method="POST">
        @csrf
        <div class="form-group">
          <label for="exampleFormControlTextarea1">Add Comment</label><br>
          <textarea class="form-control"name="comment" id="exampleFormControlTextarea1" rows="3" cols="120"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      <div class="card">
        <label>Comments</label><br>
        @foreach ($comments as $item)    
        @if($item->status == 'published')
            <p style="color:rgb(47, 13, 240)">{{$item->comment}}   
        @endif
          </p>
        @endforeach
      </div>
  </div>
  <div class="rightcolumn">
    <div class="card">
      <h2>About Me</h2>
      <div class="fakeimg" style="height:100px;">Just me, myself and I, exploring the universe of uknownment. I have a heart of love and a interest of lorem ipsum and mauris neque quam blog. I want to share my world with you.</div>
      <p></p>
    </div>
  </div>
</div>

<div class="footer">
  <h2>Footer</h2>
</div>

</body>
</html>
