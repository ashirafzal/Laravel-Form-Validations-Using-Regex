<?php

namespace App\Helpers;

use App\DemoUser;
use App\Post;
use App\SubPost;
use App\User;
use Illuminate\Support\Facades\Auth;

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

    public static function getUserPosts()
    {
        $user = User::with(["posts" => function ($q) {
            $q->with(["subposts" => function ($query) {
                $query->where('check_box', true);
            }])->where('user_id', '=', Auth::user()->id)
                ->where('check_box', true);
        }])->get();

        return $user;
    }


    public static function getSubPostDetails()
    {
        $subpost = SubPost::with(['posts' => function ($q) {
            $q->with('user')->get();
        }])
            ->where('check_box', true)
            ->get();

        return $subpost;
    }

}