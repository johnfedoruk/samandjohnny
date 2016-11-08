@extends("main")

@section("title","Categories")

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
              "route"=>"categories.store",
              "method"=>"POST"
            ]
          )
        !!}
          {!!
            Form::label(
              "name",
              "New Category"
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
        Categories
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
          @foreach($categories as $category)
            <tr>
              <th>
                {{$category->id}}
              </th>
              <td>
                {{$category->name}}
              </td>
              <td>
                {!!
                  Form::open(
                    [
                      "method"=>"DELETE",
                      "route"=>[
                        "categories.destroy",
                        $category->id
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
                <a href="{{route('categories.edit',['id'=>$category->id])}}" class="btn btn-default pull-right" style="margin-right:20px;">Edit</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="col-md-3 col-md-offset-1">
    </div>
  </div>
@endsection
