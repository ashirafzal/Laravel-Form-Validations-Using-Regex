<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubPost extends Model
{
    use SoftDeletes;

    public function posts()
    {
        return $this->hasOne(Post::class,'id','post_id');
    }

}
