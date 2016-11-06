<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use Session;

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
      return view("posts.create");
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
      $this->validate($request,array(
        "title" => "required|max:255|unique:posts,title",
        "body" => "required"
      ));

      // store in the Database
      $post = new Post;

      $post->title = $request->title;
      $post->slug = str_slug($request->title,"-");
      $post->body = $request->body;

      $post->save();

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
      return view("posts/edit")->withPost($post);
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

      $rules = ["body" => "required"];
      if($post->title!=$request->title)
        $rules["title"] = "required|max:255|unique:posts,slug";
      if($post->slug!=$request->slug)
        $rules["slug"] = "required|unique:posts,slug";

      // validate data
      $this->validate($request,$rules);

      // save data to Database
      $post = Post::find($id);

      $post->title = $request->title;
      $post->slug = $request->slug;
      $post->body = $request->body;

      $post->save();

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
}
