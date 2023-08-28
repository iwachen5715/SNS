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


    public function follow(User $user)
    {
        // if (Auth::check()) {
        //     Auth::user()->follow($user->id);
        // }
        // return back();
        $follower = auth()->user();
        //フォローしているか
        $is_following = $follower->isFollowing($user->id);
    if(!$is_following) {
        //フォローしていなければフォローする
        $follower->follow($user->id);
        return back();
        }
    }

    public function unfollow(User $user)
    {
        // if (Auth::check()) {
        //     Auth::user()->unfollow($user->id);
        // }
        // return back();
        $follower = auth()->user();
        //フォローしているか
        $is_following = $follower->isFollowing($user->id);
        if($is_following) {
            //フォローしていればフォローを解除する
            $follower->unfollow($user->id);
            return back();
        }
    }
}








    // public function follow(User $user)
    // {
    //     // dd($request);
    //     // dd($user);
    //     $follower = Auth::User();
    //     if ($follower) {
    //         $is_following = $follower->isFollowing($user->id);
    //     if (!$is_following) {
    //         $follower->follow($user->id);
    //     }
    //   }
    //     return back();
    // }

    // public function unfollow(User $user)
    // {
    //    $follower = Auth::user();
    //    if ($follower) {
    //        $is_following = $follower->isFollowing($user->id);
    //     if ($is_following) {
    //         $follower->unfollow($user->id);
    //     }
    //   }
    //     return back();
    // }
