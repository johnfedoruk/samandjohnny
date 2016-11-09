@extends("main")

@section("title","Edit Comment")

@section("stylesheets")
  <link rel="stylesheet" href="/css/callouts.css">
@endsection

@section("javascript")
@endsection

@section("content")
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      {!!
        Form::model(
          $comment,
          [
            "method"=>"PUT",
            "route"=>[
              "comments.update",
              $comment->id
            ]
          ]
        )
      !!}
        {{
          Form::label(
            "comment",
            "Comment:"
          )
        }}
        {{
          Form::textarea(
            "comment",
            $comment->comment,
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
@endsection
