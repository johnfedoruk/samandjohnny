<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Tag;
use App\Category;
use Auth;

class BlogController extends Controller
{
  public function getIndex() {
    $posts = Post::orderBy("id","desc")->paginate(10);
    foreach($posts as $post)
      $post->body = strip_tags($post->body);
    return view('blog.index')->withPosts($posts)->withLen(255);
  }
  public function getSingle($slug) {
    $post = Post::where("slug","=",$slug)->first();
    $user = Auth::user();
    return view("blog.single")->withPost($post)->withUser($user);
  }

  public function showBlogsForTag($slug) {
    $tag = Tag::where("slug",$slug)->first();
    $posts = $tag->posts()->paginate(10);
    $categories = Category::orderBy("id","desc")->get();
    $tags = Tag::orderBy("id","desc")->get();
    foreach($posts as $post)
      $post->body = strip_tags($post->body);
    return view('blog.tags')->withTag($tag)->withPosts($posts)->withLen(255)->withCategories($categories)->withTags($tags);

  }
  public function showBlogsForCategory($slug) {
    $category = Category::where("slug",$slug)->first();
    $posts = $category->posts()->paginate(10);
    $categories = Category::orderBy("id","desc")->get();
    $tags = Tag::orderBy("id","desc")->get();
    foreach($posts as $post)
      $post->body = strip_tags($post->body);
    return view('blog.categories')->withCategory($category)->withPosts($posts)->withLen(255)->withCategories($categories)->withTags($tags);

  }
}
