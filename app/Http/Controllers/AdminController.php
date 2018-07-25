<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function getDashboard(){
        return view('admin.dashboard');
    }

    public function getPosts(){
        return view('admin.posts');
    }

    public function getComments(){
        return view('admin.comments');
    }

    public function getAddNewPost(){
        return view('admin.add_post');
    }

    public function getProfile(){
        return view('admin.profile');
    }
}
