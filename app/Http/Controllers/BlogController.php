<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BlogController extends Controller
{
    public function blogHome(Request $request){
        $posts = Post::with('user')
            ->with('category')->with('postMedia')
            ->where('is_published',1)
           /* ->whereMonth('created_at',Carbon::parse($request->month)->month)
            ->whereYear('created_at',$request->year)*/
            ->get();

        return view('home',['posts' => $posts]);
    }

    public function singleBlog($post_url){
        $post = Post::with('user')->with('category')->with('postMedia')->with('tags')->where('is_published',1)->where('post_url',$post_url)->first();
        return view('article',['post' => $post]);
    }
}
