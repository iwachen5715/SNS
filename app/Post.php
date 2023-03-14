<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user() {
        return $this->belongsTo("App\Models\User");
    }
    //
     protected $fillable = [//$fillableは書き換えの意味
        'post','user_id'
    ];
}
