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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added','Auth\RegisterController@added');

//ログイン中のページ
Route::get('/top','PostsController@index');
Route::get('/profile','UsersController@profile');
Route::get('/logout','Auth\LoginController@logout');

Route::get('/search','UsersController@search')->name('search');

Route::get('follow-list','FollowsController@followList');
Route::get('follower-list','FollowsController@followerList');
//フォローのルーティング
Route::post('/users/{user}/follow', 'UsersController@follow')->name('follow');
//フォロー解除のルーティング
Route::post('/users/{id}/unfollow', 'UsersController@unfollow')->name('unfollow');
//つぶやき投稿のルーティング
Route::post('post/create','PostsController@create');
//つぶやき削除のルーティング 消したいIDをここに送る URLの中
Route::get('/post/{id}/delete','PostsController@delete');
//つぶやき編集のルーティング
Route::post('post/update','PostsController@updateForm');
