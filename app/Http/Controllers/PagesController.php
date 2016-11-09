<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Mail;
use Session;

use App\Post;

class PagesController extends Controller {
  public function getIndex() {
    $posts = Post::orderBy("id","desc")->take(5)->get();
    foreach($posts as $post)
      $post->body = strip_tags($post->body);
    return view('pages.welcome')->withPosts($posts)->withLen(255);
  }
  public function getAbout() {
    return view('pages.about');
  }
  public function getContact() {
    return view('pages.contact');
  }
  public function postContact(Request $request) {
    $this->validate(
      $request,
      [
        "email"=>"required|email",
        "subject"=>"required|min:5",
        "message"=>"required|min:10"
      ]
    );
    $data = [
      "email"=>$request->email,
      "subject"=>$request->subject,
      "body_message"=>$request->message
    ];
    Mail::queue(
      "emails.contact",
      $data,
      function($message) use ($data){
        $message->from($data["email"]);
        $message->to("johnny@johnfedoruk.ca");
        $message->subject($data["subject"]);
        $message->replyTo($data["email"]);
      }
    );
    Session::flash("success","Your message has been successfully sent!");
    return redirect()->route("pages.home");
  }
}
