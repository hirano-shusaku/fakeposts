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
// ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// 認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

//認証してからのルーティング
Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'users/{id}'], function () {
        Route::post('follow', 'UserFollowController@store')->name('user.follow');
        Route::delete('unfollow', 'UserFollowController@destroy')->name('user.unfollow');
        Route::get('followings', 'UsersController@followings')->name('users.followings');
        Route::get('followers', 'UsersController@followers')->name('users.followers');
        Route::get('postlikes', 'UsersController@likeings')->name('users.postlikes'); //このルーティングが投稿をlike 
    });
    
    Route::resource('users', 'UsersController', ['only' => ['index', 'show', 'edit', 'update']]);
    Route::resource('fakeposts', 'FakepostsController', ['only' => ['store', 'destroy', 'edit', 'update']]);
    
    Route::group(['prefix' => 'fakeposts/{id}'], function () {
        Route::post('like', 'PostLikeController@store')->name('post.like');
        Route::delete('unlike', 'PostLikeController@destroy')->name('post.unlike');
    });
   
});

Route::get('/', 'FakepostsController@index');
