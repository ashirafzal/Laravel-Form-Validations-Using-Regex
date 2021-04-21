<?php

namespace App\Http\Controllers;

use App\DemoUser;
use App\Post;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WebsiteController extends Controller
{
    public function CreatePost(Request $request)
    {
        $check_box = false;

        $messages = [
            "title.required" => "Title is required",
            "title.regex" => "Post title first letter should be capital",
            "sub_title.required" => "Sub title is required",
            "image.required" => "Image is required",
            "post_details.required" => "Post Details is required",
        ];

        $validate = Validator::make($request->all(), [
            'title' => 'required|max:255|regex:/[A-Z][a-z]*/',
            'sub_title' => 'required|max:255',
            'image' => 'required|image|mimes:png,jpg,gif,svg|max:2048',
            'post_details' => 'required|max:255',
            'check_box' => 'required',
        ], $messages);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors());
        }

        if (isset($request->check_box)) {
            $check_box = true;
        } else {
            $check_box = false;
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extention = $image->getClientOriginalName();
            $filename = $extention;
            $image->move('post-images/', $filename);
            $image = $filename;
        }

        $post = new Post();

        $post->title = $request->title;
        $post->sub_title = $request->sub_title;
        $post->image = $image;
        $post->post_details = $request->post_details;
        $post->check_box = $check_box;

        $post->save();

        return redirect()->back()->withSuccess('Post has been created successfully.');
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();

        return redirect()->back()->withSuccess('Post has been deleted successfully.');
    }

    public function ViewPost($id)
    {
        $post = Post::find($id);

        return view('edit', ['post' => $post]);
    }

    public function ViewUser($id)
    {
        $DemoUser = DemoUser::find($id);

        return view('user_edit', ['DemoUser' => $DemoUser]);
    }

    public function EditPost(Request $request)
    {
        $check_box = false;

        $messages = [
            "title.required" => "Title is required",
            "title.regex" => "Post title first letter should be capital",
            "sub_title.required" => "Sub title is required",
            "image.required" => "Image is required",
            "post_details.required" => "Post Details is required",
        ];

        $validate = Validator::make($request->all(), [
            'title' => 'required|max:255|regex:/[A-Z][a-z]*/',
            'sub_title' => 'required|max:255',
            'image' => 'image|mimes:png,jpg,gif,svg|max:2048',
            'post_details' => 'required|max:255',
            'check_box' => 'required',
        ], $messages);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors());
        }

        if (isset($request->check_box)) {
            $check_box = true;
        } else {
            $check_box = false;
        }

        $post = Post::find($request->id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extention = $image->getClientOriginalName();
            $filename = $extention;
            $image->move('post-images/', $filename);
            $image = $filename;
        }

        $post->title = $request->title;
        $post->sub_title = $request->sub_title;
        $post->image = $image ?? $post->image;
        $post->post_details = $request->post_details;
        $post->check_box = $check_box;

        $post->save();

        return redirect()->back()->withSuccess('Post has been edited successfully.');
    }

    public function CreateUser(Request $request)
    {
        $active = false;
        $PasswordError = 'required|max:255|min:6';
        $PasswordErrorMessage = '';

        if (isset($request->a_z)) {
            $PasswordError = 'required|max:255|regex:/[A-Z][a-z]*/';
            $PasswordErrorMessage = 'Password should contain capital letters';
        }

        if (isset($request->numeric)) {
            $PasswordError = 'required|max:255|regex:/[0-9]/';
            $PasswordErrorMessage = 'Password should contain numbers';
        }

        if (isset($request->alpha_numeric)) {
            $PasswordError = 'required|max:255|regex:/[0-9]/';
            $PasswordErrorMessage = 'Password should contain aplha numberic characters like *!@#';
        }

        if (isset($request->a_z, $request->numeric)) {
            $PasswordError = 'required|max:255|regex:/[A-Z][a-z]*/|regex:/[0-9]/';
            $PasswordErrorMessage = 'Password should contain capital letters and numbers';
        }

        if (isset($request->a_z, $request->numeric, $request->alpha_numeric)) {
            $PasswordError = 'required|max:255|regex:/[A-Z][a-z]*/|regex:/[0-9]/|regex:/[@$!%*#?&]/';
            $PasswordErrorMessage = 'Password should contain capital letters numbers and aplha numberic characters like *!@#';
        }

        $messages = [
            "name.required" => "Name is required",
            "name.regex" => "Name should contain a capital letter",
            "email.required" => "Email is required",
            "number.required" => "Number is required",
            "number.regex" => "Number should be numeric",
            "password.required" => "Password is required",
            "password.min" => 'Password min length should be more than6',
            "password.regex" => $PasswordErrorMessage,
        ];

        $validate = Validator::make($request->all(), [
            'name' => 'required|max:255|regex:/[A-Z][a-z]*/',
            'email' => 'required|max:255|string|email|unique:demo_users',
            'number' => 'required|regex:/[0-9]/',
            'password' => $PasswordError,
        ], $messages);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors());
        }


        if (isset($request->active)) {
            $active = true;
        } else {
            $active = false;
        }

        $DemoUser = new DemoUser();

        $DemoUser->name = $request->name;
        $DemoUser->email = $request->email;
        $DemoUser->number = $request->number;
        $DemoUser->password = Hash::make($request->password);
        $DemoUser->active = $active;

        $DemoUser->save();

        return redirect()->back()->withSuccess('User has been created successfully.');
    }

    public function EditUser(Request $request)
    {
        $active = false;
        $PasswordError = 'required|max:255|min:6';
        $PasswordErrorMessage = '';

        if (isset($request->a_z)) {
            $PasswordError = 'required|max:255|regex:/[A-Z][a-z]*/';
            $PasswordErrorMessage = 'Password should contain capital letters';
        }

        if (isset($request->numeric)) {
            $PasswordError = 'required|max:255|regex:/[0-9]/';
            $PasswordErrorMessage = 'Password should contain numbers';
        }

        if (isset($request->alpha_numeric)) {
            $PasswordError = 'required|max:255|regex:/[0-9]/';
            $PasswordErrorMessage = 'Password should contain aplha numberic characters like *!@#';
        }

        if (isset($request->a_z, $request->numeric)) {
            $PasswordError = 'required|max:255|regex:/[A-Z][a-z]*/|regex:/[0-9]/';
            $PasswordErrorMessage = 'Password should contain capital letters and numbers';
        }

        if (isset($request->a_z, $request->numeric, $request->alpha_numeric)) {
            $PasswordError = 'required|max:255|regex:/[A-Z][a-z]*/|regex:/[0-9]/|regex:/[@$!%*#?&]/';
            $PasswordErrorMessage = 'Password should contain capital letters numbers and aplha numberic characters like *!@#';
        }

        $messages = [
            "name.required" => "Name is required",
            "name.regex" => "Name should contain a capital letter",
            "email.required" => "Email is required",
            "number.required" => "Number is required",
            "number.regex" => "Number should be numeric",
            "password.required" => "Password is required",
            "password.min" => 'Password min length should be more than6',
            "password.regex" => $PasswordErrorMessage,
        ];

        $validate = Validator::make($request->all(), [
            'name' => 'required|max:255|regex:/[A-Z][a-z]*/',
            'email' => 'required|max:255|string|email',
            'number' => 'required|regex:/[0-9]/',
            'password' => $PasswordError,
        ], $messages);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors());
        }


        if (isset($request->active)) {
            $active = true;
        } else {
            $active = false;
        }

        $DemoUser = DemoUser::find($request->id);

        $DemoUser->name = $request->name ?? $DemoUser->name;
        $DemoUser->email = $request->email ?? $DemoUser->email;
        $DemoUser->number = $request->number ?? $DemoUser->number;
        $DemoUser->password = Hash::make($request->password) ?? $DemoUser->password;
        $DemoUser->active = $active;

        $DemoUser->save();

        return redirect()->back()->withSuccess('User has been edited successfully.');
    }

    public function Userdestroy($id)
    {
        $DemoUser = DemoUser::find($id);
        $DemoUser->delete();

        return redirect()->back()->withSuccess('User has been deleted successfully.');
    }
}
