<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Session;

class CategoryController extends Controller
{
    public function __construct() {
      $this->middleware('auth');
      Session::flash(
        "roles",
        [
          "admin"
        ]
      );
      $this->middleware("role");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $categories = Category::orderBy("id","desc")->get();
      return view("categories.index")->withCategories($categories);
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
          "slug"=>str_slug($request->name)
        ]
      );
      // create the rules
      $rules = [
        "name"=>"required|max:255|unique:categories,name",
        "slug"=>"required|unique:tags,slug"
      ];
      // validate
      $this->validate($request,$rules);
      // store
      $category = new Category;
      $category->name = $request->name;
      $category->slug = $request->slug;
      $category->save();
      // flash success
      Session::flash("success","Category successfully saved!");
      // redirect
      return redirect()->route("categories.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $category = Category::find($id);
      return view("categories.show")->withCategory($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $category = Category::find($id);
      return view("categories.edit")->withCategory($category);
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
      // find the category
      $category = Category::find($id);
      // determine if the name has changed
      if($request->name==$category->name) {
        // flash success
        Session::flash("success","No changes made to the category!");
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
        if($request->slug!=$category->slug)
          $rules["slug"]="required|unique:categories,slug";
        // validate
        $this->validate($request,$rules);
        // store updated information
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->save();
        // flash success
        Session::flash("success","The category was successfully saved!");
      }
      // redirect
      return redirect()->route("categories.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $category = Category::find($id);
      $category->delete();

      Session::flash("success","The category post was successfully deleted!");
      return redirect()->route("categories.index");
    }
}
