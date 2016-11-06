<?php

namespace App\Http\Controllers;

use App\Post;

class PagesController extends Controller {
  public function getIndex() {
    $posts = Post::orderBy("created_at","desc")->take(5)->get();
    return view('pages.welcome')->withPosts($posts)->withLen(255);
  }
  public function getAbout() {
    return view('pages.about');
  }
  public function getContact() {
    return view('pages.contact');
  }
}
