@extends("main")

@section("title","Edit Post")

@section("stylesheets")
  <link rel="stylesheet" href="/css/parsley.css">
  <link rel="stylesheet" href="/css/select2.min.css">
  <link href="/plugins/jQuery.filer-1.3.0/css/jquery.filer.css" type="text/css" rel="stylesheet" />
  <link href="/plugins/jQuery.filer-1.3.0/css/themes/jquery.filer-dragdropbox-theme.css" type="text/css" rel="stylesheet" />
  <style>
    .waitToShow{
      opacity:0;
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
  <script src="/plugins/jQuery.filer-1.3.0/js/jquery.filer.min.js"></script>
  <script>
    $(document).ready(
      function() {
        $filter = $('#filer_input').filer(
          {
            limit: 1,
            maxSize: 4,
            extensions: ["jpg", "png", "gif"],
            showThumbs: true
          }
        );
      }
    );
    function readURL(input) {
      var ext = input.files[0]['name'].substring(input.files[0]['name'].lastIndexOf('.') + 1).toLowerCase();
      if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
        var reader = new FileReader();
        reader.onload = function (e) {
          $('#featured_image_preview').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
      }
      else {

      }
    }
  </script>
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
      <div class="row">
        <div class="col-md-8">
          <!-- image label -->
          {{
            Form::label(
              "featured_image",
              "Upload Featured Image:"
            )
          }}
          <br>
          <!-- image input -->
          <input type="file" onchange="readURL(this);" name="featured_image" id="filer_input" multiple="multiple" class="waitToShow">
        </div>
        <div class="col-md-4">
          <img id="featured_image_preview" src="{{$post->featuredImageExists()?$post->getFeaturedImagePath():''}}" />
        </div>
      </div>
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
</form>
@endsection
