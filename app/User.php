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
    //上記の記述は特定のオブジェクト（例えば、ユーザー）に関連付けられた投稿（Post）の情報を取得するためのものです

    // フォロー機能
    public function followings()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'followed_id');
    }//リレーションの記述 thisはfollowingメソッドのことを言っている

    // フォロワー機能
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'following_id');
    }
    //followersメソッドは、belongsToManyメソッドを使用して、Userモデルとfollowsテーブルの間に多対多のリレーションを定義しています。第一引数には関連するモデルクラスであるUser::classを指定し、第二引数には中間テーブルであるfollowsを指定します。

    // フォローする
    //＄Request requestはコントローラーメソッドにしか使えないのでモデルに書いても機能しない

    public function follow(Int $user_id)//Intは整数型のみ指定するもの それ以外はエラーが出る（1.2.3.4.5.６）
    {
        return $this->followings()->attach($user_id);
    }//上記のリレーションでUSERテーブルからフォローテーブルに繋げている→attach($user_id)メソッドは、中間テーブルにフォロー関係のレコードを追加している
    //followメソッドは、現在のユーザーが別のユーザーをフォローするために使用されます。followings()メソッドを介して定義されたリレーションを使用して、中間テーブルにフォロー情報を追加します。attach($user_id)メソッドは、中間テーブルにフォロー関係のレコードを追加します。$user_idは、フォローするユーザーのIDを指定します。

    // フォローを解除する
    public function unfollow(Int $user_id)
    {
         return $this->followings()->detach($user_id);
    }
    //unfollowメソッドは、現在のユーザーが別のユーザーのフォローを解除するために使用されます。followings()メソッドを介して定義されたリレーションを使用して、中間テーブルからフォロー関係のレコードを削除します。detach($user_id)メソッドは、中間テーブルから指定したユーザーIDに対応するフォロー関係のレコードを削除します。

    // フォローしているか
    public function isFollowing(Int $user_id)
    {
        return (boolean) $this->followings()->where('followed_id', $user_id)->first();
    }
    //(boolean)は、結果を「はい」か「いいえ」の形で返す。つまり、trueは「はい」を意味し、falseは「いいえ」を意味する。また真偽をチェックするときは取得するデータはオブジェクト型で取得する。

    // フォローされているか
    public function isFollowed(Int $user_id)
    {
        return (boolean) $this->followers()->where('following_id', $user_id)->first();
    }
    //->first() という部分は、条件に一致する最初の結果（フォロワーの情報）を取得します。$this->followers() という部分は、この関数を呼び出すオブジェクト（もの）の中にある「followers」というメソッド（機能）を使っています。このメソッドは、そのオブジェクトに関連付けられたフォロワー（他のユーザー）の情報を取得するために使われます。->where('following_id', $user_id) という部分は、1で取得したフォロワーの中から、「following_id」という項目（カラム）が、指定されたユーザーIDと一致するものを探します。つまり、指定されたユーザーIDをフォローしている人を見つけるための条件。

    // 他のモデルとのリレーションを設定。このコードの目的はユーザープロフィール情報とユーザーレコードを関連付けることです。
    // public function profileEdit()
    // {
    //     return $this->hasOne(Profile::class); // 1対1のリレーション
    // }



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

}
