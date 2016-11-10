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
      // get the slug
      $request->merge(
        [
          "slug"=>str_slug($request->name,"-")
        ]
      );
      // create the rules
      $rules = [
        "name"=>"required|max:255|unique:tags,name",
        "slug"=>"required|unique:tags,slug"
      ];
      // validate
      $this->validate($request,$rules);
      // store
      $tag = new Tag;
      $tag->name = $request->name;
      $tag->slug = $request->slug;
      $tag->save();
      // flash success
      Session::flash("success","The tag was successfully saved!");
      // redirect
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
      $tag = Tag::find($id);
      return view("tags.show")->withTag($tag);
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
      // find the tag
      $tag = Tag::find($id);
      // determine if the name has changed
      if($request->name==$tag->name) {
        // flash success
        Session::flash("success","No changes made to the tag!");
      }
      else {
        // get the new slug
        $request->merge(
          [
            "slug"=>str_slug($request->name,"-")
          ]
        );
        // create rules
        $rules = [
          "name"=>"required|max:255|unique:tags,name"
        ];
        // add rule if slug has changed
        if($request->slug!=$tag->slug)
          $rules["slug"]="required|unique:tags,slug";
        // validate
        $this->validate($request,$rules);
        // store updated information
        $tag->name = $request->name;
        $tag->slug = $request->slug;
        $tag->save();
        // flash success
        Session::flash("success","The tag was successfully saved!");
      }
      // redirect
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
