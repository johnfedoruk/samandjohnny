@extends("main")

@section("title","Tags")

@section("stylesheets")
@endsection

@section("javascript")
@endsection

@section("content")
  <div class="row">
    <div class="col-md-4">
      <div class="well" style="margin-top:30px;">
        {!!
          Form::open(
            [
              "route"=>"tags.store",
              "method"=>"post"
            ]
          )
        !!}
          {!!
            Form::label(
              "name",
              "New Tag"
            )
          !!}
          {!!
            Form::text(
              "name",
              "",
              [
                "class"=>"form-control"
              ]
            )
          !!}
          <br>
          {!!
            Form::submit(
              "Save",
              [
                "class"=>"btn btn-primary btn-block"
              ]
            )
          !!}
        {!!
          Form::close()
        !!}
      </div>
    </div>
    <div class="col-md-8">
      <h1>
        Tags
      </h1>
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($tags as $tag)
            <tr>
              <th>
                {{$tag->id}}
              </th>
              <td>
                {{$tag->name}}
              </td>
              <td>
                {!!
                  Form::open(
                    [
                      "method"=>"DELETE",
                      "route"=>[
                        "tags.destroy",
                        $tag->id
                      ]
                    ]
                  )
                !!}
                  {{
                    Form::submit(
                      "Delete",
                      [
                        "class"=>"btn btn-danger pull-right"
                      ]
                    )
                  }}
                {!!
                  Form::close()
                !!}
                  <a href="{{route('tags.edit',['id'=>$tag->id])}}" class="btn btn-default pull-right" style="margin-right:20px;">Edit</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection
