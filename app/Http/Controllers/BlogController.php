<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use Auth;

class BlogController extends Controller
{
  public function getIndex() {
    $posts = Post::orderBy("id","desc")->paginate(10);
    return view('blog.index')->withPosts($posts)->withLen(255);
  }
  public function getSingle($slug) {
    $post = Post::where("slug","=",$slug)->first();
    $user = Auth::user();
    return view("blog.single")->withPost($post)->withUser($user);
  }
}
