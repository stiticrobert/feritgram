<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Image;

class ProfileController extends Controller
{
    /**
     * Show profile.
     *
     * @param $name
     * @return \Illuminate\Http\Response
     */
    public function index($name)
    {
    	$user 	= User::where('name', $name)->first();
    	$images = Image::all();
    	
    	return view('profile')->withUser($user)->withImages($images);
    }
}
