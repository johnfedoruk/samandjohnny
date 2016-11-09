@extends("main")

@section("title","Contact")

@section("stylesheets")
  <link rel="stylesheet" href="/css/parsley.css">
@endsection

@section("javascript")
  <script src="/js/parsley.min.js"></script>
@endsection

@section("content")
  <div class="row">
    <div class="col-md-12">
      <h1>Contact Me</h1>
      <hr>
      <form action={{url('contact')}} method="POST" class="data-parsley-validate">
        {{csrf_field()}}
        <div class="form-group">
          <label>Email</label>
          <input id="email" name="email" class="form-control" required="" type="email" autofocus=""/>
        </div>
        <div class="form-group">
          <label>Subject</label>
          <input id="subject" name="subject" class="form-control" required="" minlength="5"/>
        </div>
        <div class="form-group">
          <label>Message</label>
          <textarea id="message" name="message" class="form-control" required="" minlength="10" placeholder="Type your message here..."></textarea>
        </div>
        <input type="submit" value="Send Message" class="btn btn-success" />
      </form>
    </div>
  </div>
@endsection
