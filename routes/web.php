<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');
Route::get('logout', 'Auth\LoginController@logout');
Route::get('profile/{name}', ['uses' => 'ProfileController@index', 'as' => 'profile']);
Route::get('uploads/{image}', ['uses' => 'ImageController@show', 'as' => 'image.show']);
Route::get('uploads/{image}/edit', ['uses' => 'ImageController@edit', 'as' => 'image.edit']);
Route::get('uploads/{image}/delete', ['uses' => 'ImageController@delete', 'as' => 'image.delete']);
Route::get('upload', ['uses' => 'ImageController@getUpload', 'as' => 'upload-get']);
Route::post('upload', [ 'uses' => 'ImageController@postUpload', 'as' => 'upload-post']);
Route::post('comments/{image_id}', ['uses' => 'CommentController@store', 'as' => 'comments.store']);
Route::put('uploads/{image}/update', ['uses' => 'ImageController@update', 'as' => 'image.update']);
Route::delete('uploads/{image}/delete', ['uses' => 'ImageController@destroy', 'as' => 'image.destroy']);
Auth::routes();