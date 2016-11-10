<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// login routes
Route::get("auth/login",["uses"=>"Auth\LoginController@showLoginForm","as"=>"auth.login"]);
Route::post("auth/login","Auth\LoginController@login");
Route::get("auth/logout",["uses"=>"Auth\LoginController@logout","as"=>"auth.logout"]);

// register routes
Route::get("auth/register",["uses"=>"Auth\RegisterController@showRegistrationForm","as"=>"auth.register"]);
Route::post("auth/register","Auth\RegisterController@register");

// password reset
Route::get("password/reset/{token}","Auth\ResetPasswordController@showResetForm");
Route::get("password/email","Auth\ForgotPasswordController@showLinkRequestForm");
Route::post("password/reset","Auth\ResetPasswordController@reset");
Route::post("password/email","Auth\ForgotPasswordController@sendResetLinkEmail");

// pages routes
Route::get('/', ["uses"=>"PagesController@getIndex","as"=>"pages.home"]);
Route::get("/home","PagesController@getIndex");
Route::get('/about', "PagesController@getAbout");
Route::get('/contact', "PagesController@getContact");
Route::post("/contact","PagesController@postContact");

// comments routes
Route::get("comments/{post_id}",["uses"=>"CommentsController@edit","as"=>"comments.edit"]);
Route::put("comments/{post_id}",["uses"=>"CommentsController@update","as"=>"comments.update"]);
Route::post("comments/{post_id}",["uses"=>"CommentsController@store","as"=>"comments.store"]);
Route::delete("comments/{post_id}",["uses"=>"CommentsController@destroy","as"=>"comments.destroy"]);

// blog routes
Route::get("/blog/{slug}", ["uses"=>"BlogController@getSingle","as"=>"blog.single"])
  ->where("slug","[\w\d\-\_]+");
Route::get("/blog", ["uses"=>"BlogController@getIndex","as"=>"blog.index"]);
Route::get("/tag/{slug}/blogs","BlogController@showBlogsForTag");
Route::get("/category/{slug}/blogs","BlogController@showBlogsForCategory");


// posts routes
Route::resource("posts","PostController");

// categories routes
Route::resource("categories","CategoryController",["except"=>["create"]]);

// tag routes
Route::resource("tags","TagController",["except"=>["create"]]);
