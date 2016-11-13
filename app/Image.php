<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function tags()
    {
    	return $this->belongsToMany('App\Tag');
    }

    public function comments()
    {
    	return $this->hasMany('App\Comment');
    }    
}