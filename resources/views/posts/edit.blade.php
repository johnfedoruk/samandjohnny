@extends("main")

@section("title","View Post")

@section("stylesheets")
@endsection

@section("javascript")
@endsection

@section("content")
  <div class="row">
    {!! Form::model(
      $post,
      [
        "method"=>"PUT",
        "route"=>[
          "posts.update",
          $post->id
        ]
      ]
    ) !!}
    <div class="col-md-8">
      <!-- title label -->
      {{
        Form::label(
        "title",
        "Title"
        )
      }}
      <!-- title input -->
      {{
        Form::text(
          "title",
          null,
          [
            "class"=>"form-control input-lg"
          ]
        )
      }}
      <!-- body label -->
      {{
        Form::label(
        "body",
        "Body",
        [
          "style"=>"margin-top:20px"
        ]
        )
      }}
      <!-- body input -->
      {{
        Form::textarea(
          "body",
          null,
          [
            "class"=>"form-control"
          ]
        )
      }}
    </div>
    <div class="col-md-4">
      <div class="well">
        <dl class="dl-horizontal">
          <dt>
            Created At:
          </dt>
          <dd>
            {{date("l, M j, Y \a\\t h:ia",strtotime($post->created_at))}}
          </dd>
          @if($post->created_at!=$post->updated_at)
            <dt>
              Last Update:
            </dt>
            <dd>
              {{date("l, M j, Y \a\\t h:ia",strtotime($post->updated_at))}}
            </dd>
          @endif
        </dl>
        <hr>
        <div class="row">
          <div class="col-sm-6">
            {!!
              Html::linkRoute(
                "posts.show",
                "Cancel",
                array($post->id),
                array("class"=>"btn btn-danger btn-block")
              )
            !!}
          </div>
          <div class="col-sm-6">
            {{
              Form::submit(
                'Save',
                [
                  "class"=>"btn btn-success btn-block"
                ]
              )
            }}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
