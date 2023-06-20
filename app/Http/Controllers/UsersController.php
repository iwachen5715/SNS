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

    public function search(Request $request)
    {
        $searchWord = $request->input('searchWord');
        $users = User::get();
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

    public function unfollow(Request $request, $id)
    {
        if (Auth::check()) {
        $user = User::findOrFail($id);
        $request->user()->unfollowing()->detach($user->id);
        }
        return back();
    }

    public function followingList(User $user)
    {
        $following = $user->following;
        return view('users.following_list', compact('following'));
    }

    public function followerList(User $user)
    {
        $followers = $user->followers;
        return view('users.followers_list', compact('followers'));
    }
}
//     public function profile()
//     {
//         return view('users.profile', ['lists' => $list]);
//     }

//     public function search(Request $request)
//     {
//         $users = User::get();
//         $searchWord = $request->input('searchWord');
//         return view('users.search', ['users' => $users, 'searchWord' => $searchWord]);
//     }

//     public function follow(Request $request, User $user)
//     {
//         $request->user()->follow($user);
//         return back();
//     }
//     //フォロー機能の記述

//         //現在のユーザーがフォローしたいユーザーを選択してフォローする機能.処理が完了したら、元のページにリダイレクト

//     //フォローを外す機能の記述
//     public function unfollow(Request $request, $id)
//     {
//         $users = User::findOrFail($id);
//         $users->followers()->detach(auth()->id());
//         return back();
//     }

//     // フォローしているユーザーのリストを取得
//     public function followingList(User $user)
//     {
//         $following = $user->following;

//         return view('following_list', compact('following'));
//     }

//     // フォロワーリストを取得
//     public function followerList(User $user)
//     {
//         $followers = $user->followers;

//         return view('followers_list', compact('followers'));
//     }
// }
