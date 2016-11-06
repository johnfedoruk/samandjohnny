@extends("main")

@section("title","Welcome")

@section("stylesheets")
@endsection

@section("javascript")
@endsection

@section("content")
  <div class="row">
    <div class="col-md-12">
      <div class="jumbotron" style="background:    linear-gradient(
  rgba(255, 255, 255, 0.75),
  rgba(255, 255, 255, 0.75)
  ),url('http://www.desktopimages.org/pictures/2015/0504/1/hacker-hacking-hack-anarchy-virus-internet-computer-sadic-anonymous-dark-code-binary-images-200620.jpg');background-size:cover;">
        <h1>Archive</h1>
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
