@extends("main")

@section("title","About")

@section("stylesheets")
@endsection

@section("javascript")
@endsection

@section("content")
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>About this blog</h1>
        <h3><span style="font-family: arial, helvetica, sans-serif; color: #333333;">What is this ugly thing I've created?</span></h3>
        <p><span style="font-family: arial, helvetica, sans-serif; color: #333333;">This is my projects blog. I know it's not going to win any design awards, however I feel like it's a good place for me to document my current projects throughout their progression.</span></p>
        <h3><span style="font-family: arial, helvetica, sans-serif; color: #333333;">Why did I build it?</span></h3>
        <p><span style="font-family: arial, helvetica, sans-serif; color: #333333;">If you would've asked me last week if I needed a blog, I would have looked at you funny. I really only built this blog because there was a nice tutorial on Laravel 5, a PHP framework, and I really wanted to follow along. So it's really just a byproduct of me learning Laravel.&nbsp;The series is on&nbsp;<a style="color: #333333;" href="https://www.youtube.com/playlist?list=PLwAKR305CRO-Q90J---jXVzbOd4CDRbVx" target="_blank">YouTube</a>.</span></p>
        <h3><span style="font-family: arial, helvetica, sans-serif; color: #333333;">Don't I already have a website?</span></h3>
        <p><span style="font-family: arial, helvetica, sans-serif; color: #333333;">I do. I built a portfolio website using Angular Material last month. Fortunately, I think these two websites will serve different purposes. Polished fruit of my work will go on my portfolio, but this blog will serve as simply a place to roughly document the process of my projects.</span></p>
        <h3><span style="font-family: arial, helvetica, sans-serif; color: #333333;">What is in the future for this blog?</span></h3>
        <p><span style="font-family: arial, helvetica, sans-serif; color: #333333;">I don't know what I will be doing with this blog in the future. At the time of writing, there is no ACL (Access Control List) that is preventing anybody from signing up as a super user and totally hacking this site. Fortunately, there is no private information stored that would be accessible to such a hack. I suppose I will implement an ACL in the very near future (I would tonight, but I leave to New York tomorrow at 5 am).</span></p>
        <p><span style="font-family: arial, helvetica, sans-serif; color: #333333;">I want to expand on this blog framework I've created and use it to create a Sam and Johnny blog where we post about our adventures in London and across the world - I suppose it will need to have additional features such as photo galleries and social media integration. I can't wait to get started with that!</span></p>
        <h3><span style="font-family: arial, helvetica, sans-serif; color: #333333;">Where can I get the source code?</span></h3>
        <p><span style="font-family: arial, helvetica, sans-serif; color: #333333;">Easy! I believe I published the source under an MIT license. So you can just steal it and do whatever you want! The source is on&nbsp;<a style="color: #333333;" href="https://github.com/johnfedoruk/projects-blog" target="_blank">GitHub</a>. Have fun!</span></p>
      </div>
    </div>
  </div>
@endsection
