<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Post;
use DB;
use App\User;
class PostsController extends Controller
{
    //
    public function index()
    {
        $list = Post::get();//Postテーブルの情報を参照
        $user = Auth::user(); // ログインユーザーを取得
        $followings = $user->followings(); // フォロー中のユーザーを取得

// dd($followings);
        $posts = Post::whereIn('user_id', $followings->pluck('users.id'))
                     ->orderBy('created_at', 'desc')
                     ->paginate(10);
        return view('posts.index',['lists'=>$list, 'followings' => $followings, 'user' => $user]);

    }


    // 下記つぶやき機能に接続するメソッドを新規追加
    public function create(Request $request)
    {
        $post = $request->input('post');
        $user_id = Auth::id();
        $request->validate([
            'post' => 'required|string|max:150',
        ]);
        Post::create([
            'user_id' => $user_id,
            'post' => $post,
        ]);
        return redirect('/top')->with('success_message', '投稿が成功しました');
    }

    //削除用メソッドの実装
    public function delete($id)//つぶやきのIDが＄idに入る
    {
        Post::where('id', $id)->delete();
        return redirect('/top');
    }//idカラムにある＄IDを削除するための記述 記述したらリターンダイレクトでトップに戻る記述になる



    //編集用メソッドの実装
    public function updateForm(Request $request)
    {
    // updateの処理
    // dd($request);
    $id = $request->input('id');
    //↑↑$requestはHTTPリクエストオブジェクトを表し、input()メソッドを使用して、リクエストパラメーターから'id'という名前の値を取得し、変数$idに代入しています。

    $up_post = $request->input('Post');

    Post::where('id',$id)->update(['post' => $up_post]);

    return redirect('/top');

    }
}
