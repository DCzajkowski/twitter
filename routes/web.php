<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/tweets', 'TweetsController@store')->name('tweets.store')->middleware('auth');

Route::get('/@{username}', 'UsersController@show');
Route::post('/follow', 'FollowsController@store')->name('follow')->middleware('auth');
Route::delete('/follow', 'FollowsController@destroy')->name('unfollow')->middleware('auth');
