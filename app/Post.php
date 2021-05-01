<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function subposts()
    {
        return $this->hasMany(SubPost::class);
    }

}
