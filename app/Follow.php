<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    //中間テーブルでフォロー機能
    protected $fillable =['user_id','following_id'];
}//リレーションの関連性をつける記述 つなげる記述。どこを中心としてリレーションすればいいのか確認する記述
