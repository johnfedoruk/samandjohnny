@extends("main")

@section("title","Post List")

@section("stylesheets")
  <link rel="stylesheet" href="/css/parsley.css">
@endsection

@section("javascript")
  <script src="/js/parsley.min.js"></script>
@endsection

@section("content")
  <div class="row">
    <div class="col-md-10">
      <h1>All Posts</h1>
    </div>

    <div class="col-md-2">
      <a href="{{route('posts.create')}}"
      class="btn btn-lg btn-block btn-primary btn-h1-spacing">
        Create
      </a>
    </div>
    <div class="col-md-12">
      <hr>
    </div>
  </div>
  <style>
    .table {
      table-layout: fixed;
      word-wrap: break-word;
    }
    @media screen and (max-width: 768px) {
      #postList thead th:nth-child(1),#postList tbody tr th:nth-child(1) {
        display:none;
      }
    }
  </style>
  <div class="row">
    <div class="col-md-12">
      <table class="table" id="postList">
        <thead>
          <th>#</th>
          <th>Title</th>
          <th>Body</th>
          <th>Category</th>
          <th>Dates</th>
          <th></th>
        </thead>
        <tbody>
          @foreach($posts as $post)
            <tr>
              <th>{{$post->id}}</td>
              <td>{{$post->title}}</td>
              <td>{{substr($post->body,0,50)}}{{(strlen($post->body)>50)?("..."):("")}}</td>
              <td>{{isset($post->category)?($post->category->name):("")}}</td>
              <td>{!!date("M j, Y",strtotime($post->created_at))!!}{!!($post->updated_at!=$post->created_at)?("<br>".date("M j, Y",strtotime($post->updated_at))):("")!!}</td>
              <td>
                <a href="{{route('posts.show',['id'=>$post->id])}}" class="btn btn-default">View</a>
                <a href="{{route('posts.edit',['id'=>$post->id])}}" class="btn btn-default">Edit</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <div class="text-center">
        {!!
          $posts->links();
        !!}
      </div>
    </div>
  </div>
@endsection
