@extends("main")

@section("title","$post->title")

@section("stylesheets")
@endsection

@section("javascript")
@endsection

@section("content")
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <h1>{{$post->title}}</h1>
      <h5>
        Published: {{date("M j, Y",strtotime($post->created_at))}}
        @if($post->created_at!=$post->updated_at)
          <br>Edited: {{date("M j, Y",strtotime($post->updated_at))}}
        @endif
      </h5>
      <p>{{$post->body}}</p>
      <hr>
      @if($post->category!=null)
        <p>Posted in: {{$post->category->name}}</p>
      @endif
      <div class="tags">
        @foreach($post->tags as $tag)
          <span class="label label-default">{{$tag->name}}</span>
        @endforeach
      </div>
    </div>
  </div>
@endsection
