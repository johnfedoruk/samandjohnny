@extends("main")

@section("title","View Post")

@section("stylesheets")
@endsection

@section("javascript")
@endsection

@section("content")
  <div class="row">
    <div class="col-md-8">
      <h1>
        {{$post->title}}
      </h1>
      <p class='lead'>
        {{$post->body}}
      </p>
    </div>
    <style>
      @media screen and (min-width: 768px) {
        .dl-horizontal dd {
          margin-left: 110px;
        }
        .dl-horizontal dt {
          width: 100px
        }
      }
    </style>
    <div class="col-md-4">
      <div class="well">
        <dl class="dl-horizontal">
          <dt>
            Url:
          </dt>
          <dd style="word-break:break-all;">
            <a href="{{url('blog/'.$post->slug)}}">{{url('blog/'.$post->slug)}}</a>
          </dd>
          <br>
          <dt>
            Category:
          </dt>
          <dd>
            {{$post->category->name}}
          </dd>
          <br>
          <dt>
            Created At:
          </dt>
          <dd>
            {{date("l, M j, Y \a\\t h:ia",strtotime($post->created_at))}}
          </dd>
          <br>
          @if($post->created_at!=$post->updated_at)
            <dt>
              Last Update:
            </dt>
            <dd>
              {{date("l, M j, Y \a\\t h:ia",strtotime($post->updated_at))}}
            </dd>
          @endif
          <div class="tags text-center">
            @if(sizeof($post->tags)>0)
              <hr>
            @endif
            @foreach($post->tags as $tag)
              <span class="label label-default">{{$tag->name}}</span>
            @endforeach
          </div>
        </dl>
        <hr>
        <div class="row">
          <div class="col-sm-6">
            {!!
              Html::linkRoute(
                "posts.edit",
                "Edit",
                array($post->id),
                array("class"=>"btn btn-primary btn-block")
              )
            !!}
          </div>
          <div class="col-sm-6">
            {!!
              Form::open(
                [
                  "method"=>"DELETE",
                  "route"=>[
                    "posts.destroy",
                    $post->id
                  ]
                ]
              )
            !!}
              {{
                Form::submit(
                  "Delete",
                  [
                    "class"=>"btn btn-danger btn-block"
                  ]
                )
              }}
            {!!
              Form::close()
            !!}
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-sm-12">
            {{
              Html::linkRoute(
                "posts.index",
                "<< See All Posts",
                [],
                [
                  "class"=>"btn btn-default btn-block"
                ]
              )
            }}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
