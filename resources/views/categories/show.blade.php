@extends("main")

@section("title","View Category")

@section("stylesheets")
@endsection

@section("javascript")
@endsection

@section("content")
<div class="row">
  <div class="col-md-8">
    <h1>
      {{$category->name}} <small>Category</small>
    </h1>
    <table class="table">
      <thead>
        <tr>
          <th>
            #
          </th>
          <th>
            Post
          </th>
          <th>
            Tags
          </th>
          <th>
          </th>
        </tr>
      </thead>
      <tbody>
        @foreach($category->posts as $post)
          <tr>
            <th>
              {{$post->id}}
            </th>
            <td>
              {{$post->title}}
            </td>
            <td>
              @foreach($post->tags as $tag)
                <span>
                  {{
                    link_to_route(
                      "tags.show",
                      $tag->name,
                      [
                        "id"=>$tag->id
                      ],
                      [
                        "class"=>"label label-default"
                      ]
                    )
                  }}
                </span>
              @endforeach
            </td>
            <td>
              {{
                link_to_route(
                  'posts.show',
                  'View',
                  [
                    'id'=>$post->id
                  ],
                  [
                    'class'=>'btn btn-default',
                    "target"=>"_self"
                  ]
                )
              }}
              {{
                link_to_route(
                  'posts.edit',
                  'Edit',
                  [
                    'id'=>$post->id
                  ],
                  [
                    'class'=>'btn btn-default',
                    "target"=>"_self"
                  ]
                )
              }}
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
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
          Category:
        </dt>
        <dd>
          {{$category->name}}
        </dd>
        <br>
        <dt>
          Posts:
        </dt>
        <dd>
          {{$category->posts->count()}}
        </dd>
        <br>
        <dt>
          Created At:
        </dt>
        <dd>
          {{date("l, M j, Y \a\\t h:ia",strtotime($tag->created_at))}}
        </dd>
        @if($tag->created_at!=$tag->updated_at)
          <br>
          <dt>
            Last Update:
          </dt>
          <dd>
            {{date("l, M j, Y \a\\t h:ia",strtotime($tag->updated_at))}}
          </dd>
        @endif
      </dl>
      <hr>
      <div class="row">
        <div class="col-sm-6">
          {!!
            Html::linkRoute(
              "categories.edit",
              "Edit",
              array($category->id),
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
              "categories.index",
              "<< See All Categories",
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
