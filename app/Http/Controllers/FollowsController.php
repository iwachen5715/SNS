<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class FollowsController extends Controller
{
    //
    public function followList(){
        return view('follows.followList');
    }
    public function followerList(){
        return view('follows.followerList');
    }

}
