@extends("main")

@section("title","Archive")

@section("stylesheets")
@endsection

@section("javascript")
@endsection

@section("content")
  <div class="row">
    <div class="col-md-12">
      <div class="jumbotron" style="background:    linear-gradient(
  rgba(255, 255, 255, 0.15),
  rgba(255, 255, 255, 1)
  ),url('http://www.gannett-cdn.com/-mm-/f30f35aa86398ef433ca6f0a9b55d5cdad641e3e/c=0-80-640-560&r=x404&c=534x401/local/-/media/Rochester/2015/02/01/B9316039889Z.1_20150201012550_000_GKI9PIVOA.1-0.jpg');background-size:cover;">
        <h1>Archive</h1>
        <p class="lead">A collection of all my blog posts</p>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      @foreach($posts as $post)
        <div class="post">
          <h2>
            {{$post->title}}
          </h2>
          <h5>
            Published: {{date("M j, Y",strtotime($post->created_at))}}
            @if($post->created_at!=$post->updated_at)
              <br>Edited: {{date("M j, Y",strtotime($post->updated_at))}}
            @endif
          </h5>
          <p>
            {{substr($post->body,0,$len)}}{{(strlen($post->body)>$len)?("..."):("")}}
          </p>
          <a href="{{url('blog/'.$post->slug)}}" class="btn btn-primary">Read More &rarr;</a>
        </div>
        @if($post!=$posts->last())
          <hr>
        @endif
      @endforeach
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col-md-8 text-center">
      {!!
        $posts->links()
      !!}
    </div>
  </div>
@endsection
