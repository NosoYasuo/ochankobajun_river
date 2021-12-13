<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function getRiverNameAttribute()
    {
        return config('river.' . $this->river_id);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    //後でViewで使う、いいねされているかを判定するメソッド。
    public function isLikedBy($user): bool {
    return Like::where('user_id', $user->id)->where('post_id', $this->id)->first() !==null;
    }
}
