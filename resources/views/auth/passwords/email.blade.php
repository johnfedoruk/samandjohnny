@extends("main")

@section("title","Password Reset")

@section("stylesheets")
@endsection

@section("javascript")
@endsection

@section("content")
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-title">
            Reset Password
          </div>
        </div>
        <div class="panel-body">
          {!!
            Form::open(
              [
                "url"=>"password/email",
                "method"=>"post"
              ]
            )
          !!}
          {!!
            Form::label(
              "email",
              "Email Address"
            )
          !!}
          {!!
            Form::email(
              "email",
              "",
              [
                "class"=>"form-control"
              ]
            )
          !!}
          <br>
          {!!
            Form::submit(
              "Reset Password",
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
    </div>
  </div>
@endsection
