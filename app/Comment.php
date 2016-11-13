<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function image()
    {
    	return $this->belongsTo('App\Image');
    }
}
