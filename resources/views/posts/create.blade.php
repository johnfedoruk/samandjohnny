@extends("main")

@section("title","Create Post")

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
              null,
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
              null,
              [
                "name"=>"tags[]",
                "id"=>"tags",
                "class"=>"form-control",
                "multiple"=>"multiple"
              ]
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
