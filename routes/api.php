<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//fallback routes
Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact folaranmijesutofunmi@gmail.com'], 404);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//user routes
//Route::get('/user/{user}/artworks', 'ArtworkController@index')->name('artwork.index');
Route::get('/user/{user}', 'UserController@show')->name('user.show');
Route::post('/user', 'UserController@store')->name('user.store');
Route::put('/user/{user}', 'UserController@update')->name('user.update');
Route::delete('/user/{user}', 'UserController@destroy')->name('user.destroy');

//artwork routes
Route::get('/user/{user}/artworks', 'ArtworkController@index')->name('artwork.index');
Route::get('/artwork/{artwork}', 'ArtworkController@show')->name('artwork.show');
Route::post('/artwork', 'ArtworkController@store')->name('artwork.store');
Route::put('/artwork/{artwork}', 'ArtworkController@update')->name('artwork.update');
Route::delete('/artwork/{artwork}', 'ArtworkController@destroy')->name('artwork.destroy');

Route::prefix('/artwork/{artwork}')->group(function () {
//comment routes
Route::get('/comments', 'CommentController@index')->name('comment.index');
Route::get('/comment/{comment}', 'CommentController@show')->name('comment.show');
Route::post('/comment', 'CommentController@store')->name('comment.store');
Route::put('/comment/{comment}', 'CommentController@update')->name('comment.update');
Route::delete('/comment/{comment}', 'CommentController@destroy')->name('comment.destroy');


//votes routes
Route::get('/votes', 'VoteController@index')->name('vote.index');
Route::get('/vote/{vote}', 'VoteController@show')->name('vote.show');
Route::post('/vote', 'VoteController@store')->name('vote.store');
Route::put('/vote/{vote}', 'VoteController@update')->name('vote.update');
Route::delete('/vote/{vote}', 'VoteController@destroy')->name('vote.destroy');

//upload routes
Route::get('/uploads', 'UploadController@index')->name('upload.index');
Route::get('/upload/{upload}', 'UploadController@show')->name('upload.show');
Route::post('/upload', 'UploadController@store')->name('upload.store');
Route::put('/upload/{upload}', 'UploadController@update')->name('upload.update');
Route::delete('/upload/{upload}', 'UploadController@destroy')->name('upload.destroy');

});