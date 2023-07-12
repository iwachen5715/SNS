<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user() {//userはuserメソッドでindexbladeに矢印ボタンでusernameの関連づけをする。
        return $this->belongsTo("App\User");
    }

    public function followings(): BelongsToMany
{
    return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'follow_id');
}
    //
     protected $fillable = [//$fillableは書き換えの意味
        'post','user_id'
    ];
}
