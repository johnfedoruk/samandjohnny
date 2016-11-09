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
      <h5>
        Published: {{date("M j, Y",strtotime($post->created_at))}}
        @if($post->created_at!=$post->updated_at)
          <br>Edited: {{date("M j, Y",strtotime($post->updated_at))}}
        @endif
      </h5>
      <p>{{$post->body}}</p>
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
  @if(Auth::check())
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
              "",
              [
                "class"=>"form-control",
                "style"=>"height:80px;resize:none;"
              ]
            )
          }}
          <div class="row text-center" style="margin-top:10px;">
            {{
              Form::submit(
                "Submit",
                [
                  "class"=>"btn btn-success"
                ]
              )
            }}
          </div>
        {{
          Form::close()
        }}
      </div>
    </div>
    <hr>
  @endif
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      @foreach($post->comments->reverse() as $comment)
        <div class="bs-callout" style="position:relative;">
          <strong>
            {{$comment->user->name}}
          </strong>
          &bull;
          <small>
            {{date("M j, Y \a\\t g:i A",strtotime($comment->created_at))}}
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
          <div>
            {!! nl2br(e($comment->comment)) !!}
          </div>
        </div>
        @if($comment!=$post->comments->last())

        @endif
      @endforeach
    </div>
  </div>
@endsection
