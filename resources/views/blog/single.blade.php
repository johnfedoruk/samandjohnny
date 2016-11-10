@extends("main")

@section("title","$post->title")

@section("stylesheets")
  <link rel="stylesheet" href="/css/callouts.css">
@endsection

@section("javascript")
@endsection

@section("content")
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <h1>{{$post->title}}</h1>
      <br>
      @if($post->featuredImageExists())
        <img class="thumbnail img-responsive center-block" src="{{$post->getFeaturedImagePath()}}" alt="{{$post->title}}"/>
      @endif
      <h4>
        <small>
          Published: {{date("M j, Y",strtotime($post->created_at))}}
          @if($post->created_at!=$post->updated_at)
            <br>Edited: {{date("M j, Y",strtotime($post->updated_at))}}
          @endif
        </small>
      </h4>
      <p>{!!$post->body!!}</p>
      <hr>
      @if($post->category!=null)
        <small>Posted in: {{$post->category->name}}</small>
      @endif
      <div class="tags">
        @foreach($post->tags as $tag)
          <span class="label label-default">{{$tag->name}}</span>
        @endforeach
      </div>
      <hr>
    </div>
  </div>



    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        {{
          Form::open(
            [
              "route"=>[
                "comments.store",
                $post->id
              ]
            ]
          )
        }}
          {{
            Form::label(
              "comment",
              "Comment:"
            )
          }}
          {{
            Form::textarea(
              "comment",
              (Auth::check())?(""):("Log in to leave a comment"),
              [
                "class"=>"form-control",
                "style"=>"height:80px;resize:none;",
                (Auth::check())?(""):("disabled")=>""
              ]
            )
          }}
          <div class="row text-center" style="margin-top:10px;">
            {{
              Form::submit(
                "Submit",
                [
                  "class"=>"btn btn-success",
                  (Auth::check())?(""):("disabled")=>""
                ]
              )
            }}
          </div>
        {{
          Form::close()
        }}
      </div>
    </div>



  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <br>
      <h3>
        <span class="glyphicon glyphicon-comment"></span>
        <font style="font-size:27px;">Comments</font>
      </h3>
      <br>
      @if($post->comments->count()<1)
        <h2>
          <small>
            No comments..
          </small>
        </h2>
      @endif
      @foreach($post->comments->reverse() as $comment)
        <div class="bs-callout" style="position:relative;">
          <h4 style="margin:5px 0">
            {{$comment->user->name}}
          </h4>
          <small>
            {{date("M j, Y \a\\t g:i A",strtotime($comment->created_at))}}
            @if($comment->updated_at!=$comment->created_at)
              <br>edited
              {{date("M j, Y \a\\t g:i A",strtotime($comment->updated_at))}}
            @endif
          </small>
          @if(isset($user->id)&&$comment->user->id==$user->id)
            {!!
              Form::open(
                [
                  "method"=>"GET",
                  "route"=>[
                    "comments.edit",
                    $comment->id
                  ]
                ]
              )
            !!}
              <button class="pull-right btn btn-primary btn-xs" type="submit"
              style="position:absolute;right:50px;top:20px;left:auto;bottom:auto;">
                <span class="glyphicon glyphicon-pencil"></span>
              </button>
            {!!
              Form::close()
            !!}
            {!!
              Form::open(
                [
                  "method"=>"DELETE",
                  "route"=>[
                    "comments.destroy",
                    $comment->id
                  ]
                ]
              )
            !!}
              <button class="pull-right btn btn-danger btn-xs" type="submit"
              style="position:absolute;right:20px;top:20px;left:auto;bottom:auto;">
                <span class="glyphicon glyphicon-remove-sign"></span>
              </button>
            {!!
              Form::close()
            !!}
          @endif
          <div style="margin-top:10px;">
            <p>
              {!! nl2br(e($comment->comment)) !!}
            </p>
          </div>
        </div>
        @if($comment!=$post->comments->last())

        @endif
      @endforeach
    </div>
  </div>
@endsection
