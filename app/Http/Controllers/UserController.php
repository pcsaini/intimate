<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function getDashboard(){
        return view('user.dashboard');
    }

    public function getCategory(){
        return view('user.category');
    }

    public function getPosts(){
        return view('user.posts');
    }

    public function getComments(){
        return view('user.comments');
    }

    public function getAddNewPost(){
        return view('user.add_post');
    }

    public function getProfile(){
        return view('user.profile');
    }
}
