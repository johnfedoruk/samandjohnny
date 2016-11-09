@extends("main")

@section("title","Edit Tags")

@section("stylesheets")
@endsection

@section("javascript")
@endsection

@section("content")
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <h1>
        Edit Tag
      </h1>
      {!!
        Form::model(
          $tag,
          [
            "method"=>"PUT",
            "route"=>[
              "tags.update",
              $tag->id
            ]
          ]
        )
      !!}
        {!!
          Form::label(
            "name",
            "Tag Name"
          )
        !!}
        <br>
        {!!
          Form::text(
            "name",
            $tag->name,
            [
              "class"=>"form-control",
              "autofocus"=>"",
              "onfocus"=>"var temp_value=this.value; this.value=''; this.value=temp_value;"
            ]
          )
        !!}
        <hr>
        <div class="row">
          <div class="col-sm-6">
            <button onClick="history.go(-1);return true;" class="btn btn-danger btn-block">
              Cancel
            </button>
          </div>
          <div class="col-sm-6">
            {!!
              Form::submit(
                "Save",
                [
                  "class"=>"btn btn-success btn-block"
                ]
              )
            !!}
          </div>
        </div>
    </div>
  </div>
@endsection
