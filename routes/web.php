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
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');

Route::post('/login', 'Auth\LoginController@login');

//新規登録用バリデートビュー
Route::get('/register', 'Auth\RegisterController@register');

Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');

Route::post('/added','Auth\RegisterController@added');

//ログイン中のページ
Route::get('/top','PostsController@index');

Route::get('/profile','UsersController@profile');

//ログアウト機能
Route::get('/logout','Auth\LoginController@logout');
//検索実装のルート
Route::get('/search','UsersController@search')->name('users.search');
//検索後に検索ワードを画面に表示する場合
Route::post('/search', 'UsersController@search')->name('search');
//URL
// Route::get('follow-list','FollowsController@followList');

// Route::get('follower-list','FollowsController@followerList');

// フォロー解除のルート
Route::get('/users/unfollow/{id}', 'UsersController@unfollow')->name('unfollow');//aタグとしてパラメーターで送っているためpostじゃだめ

// フォローのルート
Route::get('/users/follow/{id}', 'UsersController@follow')->name('follow');

//フォローリスト表示のルーティング
Route::get('/follow-list', 'PostsController@followList')->name('follow.list');

//フォロワーリストのルーティング
Route::get('/follower-list', 'PostsController@followerList')->name('follower.list');

//つぶやき投稿のルーティング
Route::post('post/create','PostsController@create');

//つぶやき削除のルーティング 消したいIDをここに送る URLの中
Route::get('/post/{id}/delete','PostsController@delete');

//つぶやき編集のルーティング
Route::post('post/update','PostsController@updateForm');

//投稿一覧表示のルート
Route::get('/posts', 'PostController@index')->name('posts.index');
