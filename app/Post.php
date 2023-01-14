<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
     protected $fillable = [//$fillableは書き換えの意味
        'post','user_id'
    ];
}
