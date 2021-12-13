<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    public function user()
    {   //usersテーブルとのリレーションを定義するuserメソッド
        return $this->belongsTo(User::class);
    }

    public function post()
    {   //boxテーブルとのリレーションを定義するboxメソッド
        return $this->belongsTo(Post::class);
    }
}
