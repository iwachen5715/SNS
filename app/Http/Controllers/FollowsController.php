<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FollowsController extends Controller
{
    //
    public function followList(){
        return view('follows.followList');
    }
    public function followerList(){
        return view('follows.followerList');
    }

    public function follow(User $user)
    {
        $follower =auth()->user();
        $is_following = $follower->isFollowing($user->id);
        if(!$is_following)
        {
            $follower->follow($user->id);
            return back();
        }
    }
    //フォロー解除
    public function unfollow(User $user)
    {
        $follower = auth()->user();
        //フォローをしているのか
        $is_following = $follower->isFollowing($user->id);
        if($is_following)
        {
            //フォローをしていないのなら解除
            $follower->unfollow($user->id);
            return back();
        }
    }
}
