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
}
