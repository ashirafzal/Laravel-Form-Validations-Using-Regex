<?php

namespace App\Helpers;

use App\DemoUser;
use App\Post;

class Helper
{
    public static function posts()
    {
        $posts = Post::paginate(20);

        return $posts;
    }

    public static function DemoUser()
    {
        $DemoUser = DemoUser::paginate(20);

        return $DemoUser;
    }
}