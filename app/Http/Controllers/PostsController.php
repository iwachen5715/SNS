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
        return view('posts.index',['lists'=>$list]);
        $list = Auth::user();
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
        //ポストテーブルに登録する記述
        return redirect('/top');
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

    $up_post = $request->input('Post');

    Post::where('id',$id)->update(['post' => $up_post]);

    return redirect('/top');

    }
}
