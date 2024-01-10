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


    //下記つぶやき機能に接続するメソッドを新規追加
    // public function create(Request $request)
    // {
    //        $post = $request->input('newPost');
    //     $user_id=Auth::id();//誰の呟きかわかるようにユーザーIDが必要
    //     Post::create([//Postテーブルを参照
    //         'user_id'=>$user_id,
    //         'post' => $post
    // ]);
    //     //ポストテーブルに登録する記述
    //     return redirect('/top');
   public function create(Request $request)
{
    // フォームからのデータが正しく取得できているか確認
    $post = $request->input('newPost');

    // データが空でないことを確認するバリデーションルールを追加
    $request->validate([
        'newPost' => 'required|string|max:150',
    ]);

    // ユーザーIDを取得
    $user_id = Auth::id();

    try {
        // Postテーブルにデータを挿入
        Post::create([
            'user_id' => $user_id,
            'post' => $post,
        ]);

        // データベース挿入成功時の処理
        return redirect('/top')->with('success_message', '投稿が成功しました');
    } catch (\Exception $e) {
        // データベース挿入エラー時の処理
        \Log::error('投稿データベース挿入エラー: ' . $e->getMessage());
          // バリデーションエラーがあればエラーメッセージを取得
        $errors = $validator->errors();

        return redirect('/top')->with('error_message', '投稿に失敗しました');
    }


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
