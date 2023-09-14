<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Post;
use Illuminate\Support\Facades\Auth;

class FollowsController extends Controller
{


    public function index()
    {
        $user = Auth::user(); // ログインユーザーを取得
        $followings = $user->followings; // フォロー中のユーザーを取得

        return view('following.index', compact('followings'));
    }


    public function follow($id)
    {
        // if (Auth::check()) {
        //     Auth::user()->follow($user->id);
        // }
        // return back();
        $follower = auth()->user();
        //フォローしているか
        $is_following = $follower->isFollowing($id);
    if(!$is_following) {
        //フォローしていなければフォローする
        $follower->follow($id);
        return back();
        }
    }

    public function unfollow($id)
    {
        // if (Auth::check()) {
        //     Auth::user()->unfollow($user->id);
        // }
        // return back();
        $follower = auth()->user();
        //フォローしているか
        $is_following = $follower->isFollowing($id);
        if($is_following) {
            //フォローしていればフォローを解除する
            $follower->unfollow($id);
            return back();
        }
    }
    //フォローリストの記述
 public function followList(){
        $following_id = Auth::user()->followings()->pluck('followed_id');//ログインしているユーザーを取得しておりAuth::user()を使用して、現在ログインしているユーザーの情報を取得しているログインユーザーがフォローしている他のユーザーのIDを、followings()メソッドを使用
        $user_id = Auth::id();
        $posts = Post::with('user')->whereIn('user_id',$following_id)->where('user_id', '!=', $user_id)->get();//フォローしているユーザーのIDが含まれている投稿を取得
//whereInメソッドを使用して、user_idカラムが$followed_idに含まれている投稿を選択,取得した投稿に関連するユーザー情報も一緒に取得
        return view('follows.followList',compact('posts'));

   }
    //フォロワーリストの記述：フォローしているユーザーの投稿表示
    public function followerList(){
        //ログインユーザーのIDを取得
        $user_id = Auth::id();
    // ユーザーが認証されているかを確認
         $followed_id  = Auth::user()->followers()->pluck('following_id');

        $posts = Post::with('user')->whereIn('user_id',$followed_id)->get();
        // ビューにデータを渡して表示
        return view('follows.followerList', compact('posts'));
  }

}
