<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Image;
use App\Tag;
use Auth;
use Session;
use Intervention\Image\ImageManagerStatic;

class ImageController extends Controller
{
    /**
     * Get upload form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUpload()
    {
        $tags = Tag::all();

        return view('image.upload')->withTags($tags);
    }

    /**
     * Save data from form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postUpload(Request $request)
    {
        $this->validate($request, array(
            'name'        =>  'required|unique:images|max:20',
            'description' =>  'required|max:255',
            'image'       =>  'required|image',
            'privacy'     =>  'required',
            ));

        $name        = $request->name;
        $description = $request->description;
        $privacy     = $request->privacy;

        $image = new Image;
        $image->user_id     = Auth::user()->id;
        $image->name        = $name;
        $image->description = $description;
        $image->url         = 'uploads/' .$name . '_large.jpg';
        $image->privacy     = $privacy;
        $image->save();

        if (isset($request->tags)) {
            $image->tags()->sync($request->tags);  
        } else {
            $image->tags()->sync(array());
        }

        $image->save();

        $img = ImageManagerStatic::make($_FILES['image']['tmp_name']);
        $img->resize(640, 640);
        $img->save('uploads/' . $name . '_large.jpg');
        $img->fit(320, 320);
        $img->save('uploads/' . $name . '_small.jpg');

        return redirect('/');
    }

    /**
     * Show image.
     *
     * @param  $image
     * @return \Illuminate\Http\Response
     */
    public function show($image)
    {
        $image  = Image::where('name', $image)->first();
        $tags   = Tag::where('image_id', $image->id);
        $userId = $image->user_id;
        $user   = User::where('id', $userId)->first();

        return view('image.show')->withUser($user)->withImage($image)->withTags($tags);
    }

    /**
     * Show the form for editing the specified image.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $image = Image::find($id);

        $tags = Tag::all();
        $tags2 = array();

        foreach ($tags as $tag) {
            $tags2[$tag->id] = $tag->name;
        }

        return view('image.edit')->withimage($image)->withTags($tags2);
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
        $image = Image::find($id);
        $this->validate($request, array(
            'name'        => 'required|unique:images|max:20',
            'description' => 'required|max:255',
            'privacy'     => 'required'
        ));

        $image->name        = $request->input('name');
        $image->description = $request->input('description');
        $image->privacy     = $request->input('privacy');
        $image->save();

        if (isset($request->tags)) {
            $image->tags()->sync($request->tags);
        } else {
            $image->tags()->sync(array());
        }

        $image->save();
        Session::flash('success', 'Slika uspješno ažurirana');

        return redirect()->route('image.show', $image->id);
    }

    /**
     * Delete confirmation.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $image = Image::find($id);

        return view('image.delete')->withImage($image);
    }

    /**
     * Remove the specified image from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = Image::find($id);
        $image->delete();
        Session::flash('success', 'Slika uspješno izbrisana');

        return redirect('/');
    }
}
