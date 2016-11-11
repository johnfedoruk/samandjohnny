<h3>Categories</h3>
<div class="list-group">
  @foreach($categories as $category)
  <a class="list-group-item" href="{{url("category/".$category->slug."/blogs")}}">
    {{$category->name}}
    <span class="badge float-xs-right">{{$category->posts->count()}}</span>
  </a>
  @endforeach
</div>
<br>
<h3>Tags</h3>
<div class="panel panel-default" style="padding:15px;">
  <div class="tags text-center" style="line-height:25px;">
    @foreach($tags as $tag)
      <a class="label label-default" style="margin:5px;word-wrap:none;display:inline-block;" href="{{url("tag/".$tag->slug."/blogs")}}">
        {{$tag->name}}
      </a>
    @endforeach
  </div>
</div>
