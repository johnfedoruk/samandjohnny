@extends("main")

@section("title","View Post")

@section("stylesheets")
  <link rel="stylesheet" href="/css/parsley.css">
  <link rel="stylesheet" href="/css/select2.min.css">
@endsection

@section("javascript")
  <script src="/js/parsley.min.js"></script>
  <script src="/js/select2.min.js"></script>
  <script type="text/javascript">
    $("#tags").select2();
  </script>
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
      ],
      [
        "data-parsley-validate"=>""
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
            "class"=>"form-control input-lg",
            "required"=>"",
            "maxlength"=>"25",
            "autofocus"=>"",
            "onfocus"=>"var temp_value=this.value; this.value=''; this.value=temp_value;"
          ]
        )
      }}
      <br>
      <!-- category label -->
      {{
        Form::label(
          "category_id",
          "Category:"
        )
      }}
      <!-- category input -->
      {{
        Form::select(
          "category_id",
          $categories,
          $post->category_id,
          [
            "class"=>"form-control"
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
            "class"=>"form-control",
            "required"=>""
          ]
        )
      }}
      <br>
      <!-- tag label -->
      {{
        Form::label(
          "tags",
          "Tags"
        )
      }}
      <!-- tag input -->
      {{
        Form::select(
          "tags",
          $tags,
          $curr_tags,
          [
            "name"=>"tags[]",
            "id"=>"tags",
            "class"=>"form-control",
            "multiple"=>"multiple"
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
            <button onClick="history.go(-1);return true;" class="btn btn-danger btn-block">
              Cancel
            </button>
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
