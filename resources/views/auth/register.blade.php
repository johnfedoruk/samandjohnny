@extends("main")

@section("title","Register")

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
        <!-- name label -->
        {{
          Form::label(
            "name",
            "Name"
          )
        }}
        <!-- name input -->
        {{
          Form::text(
            "name",
            "",
            [
              "class"=>"form-control",
              "autofocus"=>""
            ]
          )
        }}
        <br>
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
              "class"=>"form-control"
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
        <script>
          var password = document.getElementById("password")
          var password_confirmation = document.getElementById("password_confirmation");
          function validatePassword(){
            if(password.value != password_confirmation.value) {
              password_confirmation.setCustomValidity("Passwords Don't Match");
            } else {
              password_confirmation.setCustomValidity('');
            }
          }
          password.onchange = validatePassword;
          password_confirmation.onkeyup = validatePassword;
        </script>
        <br>
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
      {!!
        Form::close()
      !!}
    </div>
  </div>
@endsection
