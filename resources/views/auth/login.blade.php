@extends("main")

@section("title","Login")

@section("stylesheets")
@endsection

@section("javascript")
@endsection

@section("content")
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      {!!
        Form::open()
      !!}
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
              "autofocus"=>""
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
              "class"=>"form-control"
            ]
          )
        }}
        <br>
        <!-- remember-me checkbox -->
        {{
          Form::checkbox(
            "remember"
          )
        }}
        <!-- remember-me label -->
        {{
          Form::label(
            "remember",
            "Remember Me"
          )
        }}
        <br>
        <!-- submit button -->
        {{
          Form::submit(
            "Login",
            [
              "class"=>"btn btn-success btn-block"
            ]
          )
        }}
        <br>
        <p>
          <a href="{{url('password/email')}}">I Forgot my password</a>
        </p>
      {!!
        Form::close()
      !!}
    </div>
  </div>
@endsection
