<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Post;
use DB;
class PostsController extends Controller
{
    //
    public function index()
    {
        $list = Post::get();//Postテーブルの情報を参照
        return view('posts.index',['lists'=>$list]);
    }
    //下記つぶやき機能に接続するメソッドを新規追加
    public function create(Request $request)
    {
        $post = $request->input('newPost');
        $user_id=Auth::id();//誰の呟きかわかるようにユーザーIDが必要
        Post::create([//Postテーブルを参照
            'user_id'=>$user_id,
            'post' => $post
    ]);
    // DB::table('posts')->insert([
    //     'user_id'=>$user_id,
    //     'post' => $post
    // ]);
        //ポストテーブルに登録する記述
        return redirect('/top');
    }
}
