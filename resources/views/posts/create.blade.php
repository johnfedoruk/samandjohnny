@extends("main")

@section("title","Create Post")

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
    $(document).ready(function() {
      $('#filer_input').filer(
        {
          limit: 1,
          maxSize: 4,
          extensions: ["jpg", "png", "gif"],
          showThumbs: true
        }
      );
    });
  </script>
  <!--
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script src="/plugins/jQuery-File-Upload-9.14.0/js/vendor/jquery.ui.widget.js"></script>
  <script src="/plugins/jQuery-File-Upload-9.14.0/js/jquery.iframe-transport.js"></script>
  <script src="/plugins/jQuery-File-Upload-9.14.0/js/jquery.fileupload.js"></script>
  <script>
    $(function () {
        $('#filer_input').fileupload({
            dataType: 'json',
            done: function (e, data) {
                $.each(data.result.files, function (index, file) {
                    $('<p/>').text(file.name).appendTo(document.body);
                });
            }
        });
    });
  </script>
-->
<script>
  $(".waitToShow").fadeIn(5000);
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
              "data-parsley-validate"=>"",
              "files"=>"true"
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
                "maxlength"=>"255",
                "autofocus"=>""
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
          <!--
          <label class="btn btn-default btn-file">
            Browse <input type="file" name='featured_image' style="display: none;">
          </label>-->
          <input type="file" name="featured_image" id="filer_input" multiple="multiple" class="waitToShow">
          <br>
          <!-- body label -->
          {{
            Form::label(
              "body",
              "Body"
            )
          }}
          <!-- body input -->
          {{
            Form::textarea(
              "body",
              null,
              array(
                "class"=>"form-control waitToShow",
                "required"=>"",
                "style"=>"display:none;"
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
