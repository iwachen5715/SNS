<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Post;


class User extends Authenticatable
{
    use Notifiable;

    // 1対多のリレーション
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // フォロー機能
    public function followings()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'user_id');
    }

    // フォロワー機能
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'follower_id');
    }

    // フォローする
    public function follow($user_id)
    {
        $this->followings()->attach($user_id);
    }

    // フォローを解除する
    public function unfollow($user_id)
    {
         $this->followings()->detach($user_id);
    }

    // フォローしているか
    public function isFollowing($user_id)
    {
        return $this->followings()->where('follower_id', $user_id)->exists();
    }

    // フォローされているか
    public function isFollowed($user_id)
    {
        return $this->followers()->where('user_id', $user_id)->exists();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    // use Notifiable;

    // //1対多のリレーション
    // public function posts()
    // {
    //     return $this->hasMany("App\Post");
    // }

    // //フォロー機能
    // public function following()
    // {
    //     return $this ->belongsToMany('App\User','follows','following_id','followed_id');
    // }
    // //フォロー解除
    // public function followed()
    // {
    //     return $this->belongsToMany('App\User','follows','followed_id','following_id');
    // }
    // //フォローする
    // public function follow(int $user_id)
    // {
    //     //上記メソッドを揃える
    //     return $this->following()->attach($user_id);
    // }

    // //フォローを解除する
    // public function unfollow($user_id)
    // {
    //     return $this->following()->detach($user_id);
    // }
    // //フォローしているか
    // public function isFollowing($user_id)
    // {
    //     return $this->following()->where('following_id', $user_id)->exists();
    // }
    // //フォローされているか
    // public function isFollowed($user_id)
    // {
    //     return $this->followed()->where('followed_id', $user_id)->exists();
    // }



    // /**
    //  * The attributes that are mass assignable.
    //  *
    //  * @var array
    //  */
    // protected $fillable = [
    //     'username', 'mail', 'password',
    // ];

    // /**
    //  * The attributes that should be hidden for arrays.
    //  *
    //  * @var array
    //  */
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];
}
