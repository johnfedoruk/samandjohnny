@extends("main")

@section("title","Contact")

@section("stylesheets")
@endsection

@section("javascript")
@endsection

@section("content")
  <div class="row">
    <div class="col-md-12">
      <h1>Contact Me</h1>
      <hr>
      <form>
        <div class="form-group">
          <label>Email</label>
          <input id="email" class="form-control" />
        </div>
        <div class="form-group">
          <label>Subject</label>
          <input id="subject" class="form-control" />
        </div>
        <div class="form-group">
          <label>Message</label>
          <textarea id="message" class="form-control" >Type your message here...</textarea>
        </div>
        <input type="submit" value="Send Message" class="btn btn-success" />
      </form>
    </div>
  </div>
@endsection
