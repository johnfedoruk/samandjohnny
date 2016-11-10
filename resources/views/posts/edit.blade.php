@extends("main")

@section("title","View Post")

@section("stylesheets")
  <link rel="stylesheet" href="/css/parsley.css">
  <link rel="stylesheet" href="/css/select2.min.css">
  <style>
    .waitToShow {
      display: none;
    }
  </style>
@endsection

@section("javascript")
  <script src="/js/parsley.min.js"></script>
  <script src="/js/select2.min.js"></script>
  <script type="text/javascript">
    $("#tags").select2();
  </script>
  <script src="/plugins/tinymce/js/tinymce/tinymce.min.js"></script>
  <script src="/js/tinymce.config.js"></script>
  <script>
    $(".waitToShow").fadeIn(5000);
  </script>
@endsection

@section("content")
  <div class="row">
    {!!
      Form::model(
      $post,
      [
        "method"=>"PUT",
        "route"=>[
          "posts.update",
          $post->id
        ],
        "data-parsley-validate"=>"",
        "files"=>"true"
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
          $post->title,
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
      <br>
      <!-- image label -->
      {{
        Form::label(
          "featured_image",
          "Upload Featured Image:"
        )
      }}
      <br>
      <!-- image input -->
      <label class="btn btn-default btn-file">
        Browse <input type="file" name='featured_image' style="display: none;">
      </label>
      <br>
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
          $post->body,
          [
            "class"=>"form-control waitToShow",
            "required"=>"",
            "style"=>"display:none;"
          ]
        )
      }}
      <br>
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
            "multiple"=>"multiple",
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
  <iframe id="form_target" name="form_target" style="display:none"></iframe>
<form id="my_form" action="/upload/" target="form_target" method="post" enctype="multipart/form-data" style="width:0px;height:0;overflow:hidden">
  <input name="image" type="file" onchange="$('#my_form').submit();this.value='';">
</form>
@endsection
