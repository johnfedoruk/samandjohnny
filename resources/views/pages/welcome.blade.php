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
  rgba(255, 255, 255, 0.15),
  rgba(255, 255, 255, 1)
  ),url('http://www.desktopimages.org/pictures/2015/0504/1/hacker-hacking-hack-anarchy-virus-internet-computer-sadic-anonymous-dark-code-binary-images-200620.jpg');background-size:cover;">
        <h1>Welcome {{Auth::check()?Auth::user()->name:"to my blog!!"}}</h1>
        <p class="lead">Thank you for visiting</p>
        <p><a class="btn btn-primary btn-lg" href="http://johnfedoruk.co.uk" target="_blank" role="button">View my profile</a></p>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-8">
      @foreach($posts as $post)
        <div class="post">
          <h3>{{$post->title}}</h3>
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
    <div class="col-md-3 col-md-offset-1">
      <h3>Sidebar</h3>
      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col-md-8 text-center">

    </div>
  </div>
@endsection
