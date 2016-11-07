<!-- default Bootstrap navbar -->
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{route('blog.index')}}">Johnny's Project Blog</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li {{ Request::is("/") ? "class=active" : "" }}>
          <a href="{{ Request::is("/") ? '#' : '/' }}">
            Home
            {!! Request::is("/") ? "<span class='sr-only'>(current)</span>" : "" !!}
          </a>
        </li>
        <li {{ Request::is("about") ? "class=active" : "" }}>
          <a href="{{ Request::is("about") ? '#' : '/about' }}">
            About
            {!! Request::is("about") ? "<span class='sr-only'>(current)</span>" : "" !!}
          </a>
        </li>
        <li {{ Request::is("contact") ? "class=active" : "" }}>
          <a href="{{ Request::is("contact") ? '#' : '/contact' }}">
            Contact
            {!! Request::is("contact") ? "<span class='sr-only'>(current)</span>" : "" !!}
          </a>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{Auth::check()?Auth::user()->name:"Account"}} <span class="caret"></span></a>
          <ul class="dropdown-menu">
            @if(Auth::check())
              <li><a href="{{route('posts.create')}}">Create A Post</a></li>
              <li><a href="{{route('posts.store')}}">List All Posts</a></li>
              <li><a href="{{route('categories.index')}}">Manage Categories</a></li>
              <li><a href="{{route('auth.logout')}}">Logout</a></li>
            @else
              <li><a href="{{route('auth.login')}}">Login</a></li>
              <li><a href="{{route('auth.register')}}">Register</a></li>
            @endif
            <li role="separator" class="divider"></li>
            <li><a href="http://johnfedoruk.co.uk" target="_blank">Johnny's Portfolio</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
