<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Auth;
use App\User;

class UsersController extends Controller
{
    //
    public function profile(){
        return view('users.profile',['lists' => $list]);
    }
    public function search(Request $request)//$requestという引数を持っている。ユーザーを検索することであり、$usersという変数にすべてのユーザーを格納し、$searchWordという変数にユーザーが検索した単語を格納
    {
        $users =User::get();
        $searchWord =$request->input('searchWord');
        //$request->input('searchWord')は、HTTPリクエストのパラメーターから、"searchWord"という名前のパラメーターの値を取得
    //usersテーブルから全てのレコード情報を取り入れる。全員のユーザーが入っている。
        return view('users.search',['users' => $users, 'searchWord' => $searchWord]);
        //withメソッドはビューに渡す変数をキーと値のペアで指定するメソッド
    }
}
