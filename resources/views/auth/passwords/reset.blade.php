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
            Enter a New Password {{$email}}
          </div>
        </div>
        <div class="panel-body">
          {!!
            Form::open(
              [
                "url"=>"password/reset",
                "method"=>"post"
              ]
            )
          !!}
            <!-- token -->
            {{
              Form::hidden(
                "token",
                $token
              )
            }}
            <!-- email label -->
            {{
              Form::label(
                "email",
                "Email:"
              )
            }}
            <!-- email input -->
            {{
              Form::email(
                "email",
                "",
                [
                  "class"=>"form-control",
                  //"readonly"=>"readonly"
                ]
              )
            }}
            <br>
            <!-- password label -->
            {{
              Form::label(
                "password",
                "Password:"
              )
            }}
            <!-- password input -->
            {{
              Form::password(
                "password",
                [
                  "id"=>"password",
                  "class"=>"form-control"
                ]
              )
            }}
            <br>
            <!-- password2 label -->
            {{
              Form::label(
                "confirm_password",
                "Confirm Password:"
              )
            }}
            <!-- password2 input -->
            {{
              Form::password(
                "password_confirmation",
                [
                  "id"=>"password_confirmation",
                  "class"=>"form-control"
                ]
              )
            }}
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
