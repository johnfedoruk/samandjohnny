<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Category;
use App\Tag;
use Session;
use Purifier;
use Image;

class PostController extends Controller
{
    public function __construct() {
      $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // create a variable and store all the blog posts in it from the Database
      $posts = Post::orderBy("id","desc")->paginate(10);
      foreach($posts as $post)
        $post->body = strip_tags($post->body);

      // return a view and pass in the above variable
      return view("posts.index")->withPosts($posts);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $categories = Category::all();
      $cat_array = [];
      foreach($categories as $category)
        $cat_array[$category->id]=$category->name;
      $tags = Tag::all();
      $tag_array = [];
      foreach($tags as $tag)
        $tag_array[$tag->id]=$tag->name;
      return view("posts.create")->withCategories($cat_array)->withTags($tag_array);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // validate the data
      $rules = [
        "title" => "required|max:255|unique:posts,title",
        "body" => "required",
        "category_id" => "required|integer|exists:categories,id"
      ];
      $this->validate($request,$rules);

      // store in the Database
      $post = new Post;

      $post->title = $request->title;
      $post->slug = str_slug($request->title,"-");
      $post->body = $this->removeScriptTags($request->body);
      if(isset($request->category_id))
        $post->category_id = $request->category_id;

      $post->save();
      if(isset($request->tags))
        $post->tags()->sync($request->tags,false);

      $this->saveFeaturedImage($request,$post);

      Session::flash("success","The blog post was successfully saved!");

      // redirect to another page (index or show, probably)
      return redirect()->route("posts.show",$post->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $post = Post::find($id);
      return view("posts/show")->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $post = Post::find($id);
      // get all categories
      $categories = Category::all();
      $cat_array = [];
      foreach($categories as $category)
        $cat_array[$category->id]=$category->name;
      // get all tags
      $tags = Tag::all();
      $tag_array = [];
      foreach($tags as $tag)
        $tag_array[$tag->id]=$tag->name;
      // get a list of the current tags' ids
      $curr_tags = $post->tags;
      $curr_tag_array = [];
      foreach($curr_tags as $curr_tag)
        $curr_tag_array[]=$curr_tag->id;

      return view("posts/edit")->with(
        [
          "post"=>$post,
          "categories"=>$cat_array,
          "tags"=>$tag_array,
          "curr_tags"=>$curr_tag_array
        ]
      );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

      // get the slug
      $request->merge(
        [
          "slug"=>str_slug($request->title,"-")
        ]
      );

      $post = Post::find($id);

      $rules = [
        "body" => "required",
        "category_id" => "required|integer|exists:categories,id"
      ];
      // update title only if it has changed
      if($post->title!=$request->title)
        $rules["title"] = "required|max:255|unique:posts,slug";
      // update slug only if it has changed
      if($post->slug!=$request->slug)
        $rules["slug"] = "required|unique:posts,slug";

      // validate data
      $this->validate($request,$rules);

      // save data to Database
      $post = Post::find($id);

      $post->title = $request->title;
      $post->slug = $request->slug;
      $post->body = $this->processPost($request->body);
      $post->category_id = $request->category_id;

      $post->save();

      $this->saveFeaturedImage($request,$post);

      if(isset($request->tags))
        $post->tags()->sync($request->tags,true);
      else
        $post->tags()->sync([],true);

      // set flash data with success message
      Session::flash("success","The blog post was successfully saved!");

      // redirect with flash data to posts.show
      return redirect()->route("posts.show",$post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $post = Post::find($id);

      $post->delete();

      Session::flash("success","The blog post was successfully deleted!");

      // redirect to another page (index or show, probably)
      return redirect()->route("posts.index");
    }
    protected function removeScriptTags($html) {
      return preg_replace('#<script(.*?)>(.*?)</script>#is', '', $html);
    }
    protected function saveFeaturedImage(Request $request,Post $post) {
      if($request->hasFile('featured_image')) {
        $image = $request->file('featured_image');
        $filename = $post->id.".jpg";
        $location = public_path("images/".$filename);
        Image::make($image)->resize(
          800,
          null,
          function($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
          }
        )->encode("jpg")->save($location);
      }
    }
    protected function processPost($post) {
      return $this->removeScriptTags($post);
    }
}
