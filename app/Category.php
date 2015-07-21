<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	public $timestamps = false;

	public function movies()
  {
      return $this->hasMany('App\Movie');
  }
}