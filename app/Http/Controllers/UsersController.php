<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;


class UsersController extends Controller
{
     public function profile()
    {
        return view('users.profile');
    }
//ユーザー検索の実装のコード
    public function search(Request $request)
{
    $searchWord = $request->input('searchWord');
    if ($searchWord) {
        $users = User::where('username', 'like', '%' . $searchWord . '%')
                     ->get();
    } else {
        $users = User::all();
    }
    return view('users.search', compact('users', 'searchWord'));
}

    public function follow(User $user,$id)
    {
        if (Auth::check()) {
        // $request->user()->following()->attach($user->id);
        }
        $following=auth()->user();//$followingは変数あだ名をつけている
        $following->follow($id);//idを使ってフォローしといてという意味

        return redirect('/search');//毎回検索画面に戻るようにリダイレクトしている
    }

    public function unfollow($id)//入力フォームで送っていないためREQUEST $REQUEST入らない
    {
        if (Auth::check()) {
        $user = User::findOrFail($id);
        $following=auth()->user();
        $following->unfollow($id);
        }
        return back();
    }




    //フォローリストのユーザーアイコン表示
//      public function followList()
//     {
//         $user = auth()->user(); // ログインユーザーの取得

//         // フォローリストの取得
//         $followings = $user->followings()->with('profile')->get();//with('profile')を使用して、取得したフォローリストのユーザーに関連付けられたプロフィール情報も同時に取得する。

//         return view('follow-list', compact('followings'));//compact()関数は、指定した変数名をキーとして、それに対応する変数の値を含む連想配列を作成
//         //get()メソッドを使用して、上記のクエリを実行し、フォローリストを取得。//compact('followings')を使用して、取得したフォローリストをビューに渡す

//     }

//    public function followerList()
//     {
//         $user = auth()->user(); // ログインユーザーの取得

//         // フォロワーリストの取得
//         $followers = $user->with('profile')->get();//with('profile')を使用して、取得したフォロワーリストのユーザーに関連付けられたプロフィール情報も同時に取得する。

//         return view('follower-list', compact('followers'));//get()メソッドを使用して、上記のクエリを実行し、フォロワーリストを取得。//compact('followings')を使用して、取得したフォロワーリストをビューに渡す
//     }
}
