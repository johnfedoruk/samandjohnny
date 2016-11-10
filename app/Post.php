<?php

namespace App;
use File;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  public function category() {
    return $this->belongsTo("App\Category");
  }
  public function tags() {
    return $this->belongsToMany("App\Tag");
  }
  public function comments() {
    return $this->hasMany("App\Comment");
  }
  public function getFeaturedImagePath() {
    return asset("images/".$this->id.".jpg");
  }
  public function featuredImageExists() {
    return file_exists(public_path()."/images/".$this->id.".jpg");
  }
}
