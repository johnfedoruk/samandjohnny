<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Post;
use App\Comment;
use Auth;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$post_id)
    {
      $this->validate(
        $request,
        [
          "comment"=>"required|min:3|max:2000"
        ]
      );
      $post = Post::find($post_id);
      $comment = new Comment();
      $comment->comment = $request->comment;
      $comment->post()->associate($post);
      $comment->user()->associate(Auth::user()->id);
      $comment->save();

      Session::flash("success","Comment was successfully posted!");

      return redirect()->route("blog.single",[$post->slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $comment = Comment::find($id);
      $this->authorizeUser($comment);
      return view("comments.edit")->withComment($comment);
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
        $this->validate(
          $request,
          [
            "comment"=>"required|min:3|max:2000"
          ]
        );
        $comment = Comment::find($id);
        $this->authorizeUser($comment);
        $comment->comment = $request->comment;
        $comment->save();

        return redirect()->route("blog.single",[$comment->post->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $comment = Comment::find($id);
      $this->authorizeUser($comment);
      $comment->delete();
      Session::flash("success","Comment was successfully deleted!");
      return redirect()->back();
    }
    protected function authorizeUser($comment) {
      if(!Auth::check()||$comment->user->id!=Auth::user()->id) {
        return redirect()->route("blog.single",[$comment->post->slug])->withErrors(["Unauthorized Action!"]);
      }
    }
}
