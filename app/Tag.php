<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function images()
    {
    	return $this->belongsToMany('App\Image');
    }
}
