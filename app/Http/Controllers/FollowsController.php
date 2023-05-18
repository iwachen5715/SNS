<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
class FollowsController extends Controller
{
    public function follow(Request $request, User $user)
    {
        $request->user()->follow($user);
        return back();
    }

    public function unfollow(Request $request, User $user)
    {
        $request->user()->unfollow($user);
        return back();
    }
}
