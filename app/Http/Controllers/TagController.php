<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tag;
use Session;

class TagController extends Controller
{
    public function __construct() {
      $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $tags = Tag::orderBy("id","desc")->get();
      return view("tags.index")->withTags($tags);
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
    public function store(Request $request)
    {
      $rules = [
        "name"=>"required|max:255|unique:tags,name"
      ];
      $this->validate($request,$rules);

      $tag = new Tag;
      $tag->name = $request->name;
      $tag->save();

      Session::flash("success","The tag was successfully saved!");

      return redirect()->route("tags.index");
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
      $tag = Tag::find($id);
      return view("tags.edit")->withTag($tag);
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
      $rules = [
        "name"=>"required|max:255|unique:tags,name"
      ];
      $this->validate($request,$rules);

      $tag = new Tag;
      $tag->name = $request->name;
      $tag->save();

      Session::flash("success","The tag was successfully saved!");

      return redirect()->route("tags.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $tag = Tag::find($id);
      $tag->delete();

      Session::flash("success","The tag was successfully deleted!");

      return redirect()->route("tags.index");
    }
}
