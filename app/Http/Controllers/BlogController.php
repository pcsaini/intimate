<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BlogController extends Controller
{
    public function posts(){
        $posts = Post::with('user')
            ->with('category')
            ->with('postMedia')
            ->where('is_published',1)
            ->get();

        return view('home',['posts' => $posts]);
    }

    public function postByArchives($month,$year){
        $posts = Post::with('user')
            ->with('category')
            ->with('postMedia')
            ->where('is_published',1)
            ->whereMonth('created_at',Carbon::parse($month)->month)
            ->whereYear('created_at',$year)
            ->get();

        return view('home',['posts' => $posts]);
    }

    public function postByTags($id){
        $posts = Post::leftJoin('post_tag','posts.id','=','post_tag.post_id')
            ->with('user')
            ->with('category')
            ->with('postMedia')
            ->where('is_published',1)
            ->where('post_tag.tag_id',$id)
            ->get();

        return view('home',['posts' => $posts]);
    }

    public function postByUsers($id){
        $posts = Post::with('user')
            ->with('category')
            ->with('postMedia')
            ->where('is_published',1)
            ->where('user_id',$id)
            ->get();

        return view('home',['posts' => $posts]);
    }

    public function postByCategory($cat_id){
        $posts = Post::with('user')
            ->with('category')
            ->with('postMedia')
            ->where('is_published',1)
            ->where('category_id',$cat_id)
            ->get();

        return view('home',['posts' => $posts]);
    }

    public function singleBlog($post_url){
        $post = Post::with('user')
            ->with('category')->with('postMedia')
            ->with('tags')
            ->where('is_published',1)
            ->where('post_url',$post_url)
            ->first();
        return view('article',['post' => $post]);
    }
}
