<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Comment;
use App\Image;
use Session;

class CommentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $image_id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $image_id)
    {
        $this->validate($request, array(
            'name'      =>  'required|max:255',
            'email'     =>  'required|email|max:255',
            'comment'   =>  'required|min:5|max:2000'
            ));

        $image = Image::find($image_id);

        $comment = new Comment();
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->comment = $request->comment;
        $comment->approved = true;
        $comment->image()->associate($image);
        $comment->save();

        Session::flash('success', 'Komentirali ste');

        return redirect()->route('image.show', $image->name);
    }

}
