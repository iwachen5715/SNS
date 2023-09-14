<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
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
        $users = User::where('id', '!=', Auth::id())->get();
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
}
