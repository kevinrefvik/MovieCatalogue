<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
	public function format() {
		return $this->belongsTo('App\Format');
	}

	public function category() {
		return $this->belongsTo('App\Category');
	}
}