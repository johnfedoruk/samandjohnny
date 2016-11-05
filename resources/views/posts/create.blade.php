@extends("main")

@section("title","Create Post")

@section("stylesheets")
  <link rel="stylesheet" href="/css/parsley.css">
@endsection

@section("javascript")
  <script src="/js/parsley.min.js"></script>
@endsection

@section("content")
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <h1>
          Create New Post
        </h1>
        <hr>
        {!!
          Form::open(
            array(
              "route"=>"posts.store",
              "data-parsley-validate"=>""
            )
          )
        !!}
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
              array(
                "class"=>"form-control",
                "required"=>"",
                "maxlength"=>"255"
              )
            )
          }}
          <!-- body label -->
          {{
            Form::label(
              "body",
              "Body",
              array(
                "style"=>"margin-top:20px;"
              )
            )
          }}
          <!-- body input -->
          {{
            Form::textarea(
              "body",
              null,
              array(
                "class"=>"form-control",
                "required"=>""
              )
            )
          }}
          <!-- submit button -->
          {{
            Form::submit(
              "Create Post",
              array(
                "class"=>"btn btn-success btn-lg btn-block",
                "style"=>"margin-top:20px"
              )
            )
          }}
        {!!
          Form::close()
        !!}
      </div>
    </div>
@endsection
