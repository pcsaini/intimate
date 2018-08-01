<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comments;
use App\Post;
use App\RegularUser;
use App\Reply;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function posts(){
        $posts = Post::with('user')
            ->with('category')
            ->with('postMedia')
            ->where('is_published',1)
            ->orderBy('created_at','decs')
            ->paginate(5);

        return view('home',['posts' => $posts]);
    }

    public function postByArchives($month,$year){
        $posts = Post::with('user')
            ->with('category')
            ->with('postMedia')
            ->where('is_published',1)
            ->whereMonth('created_at',Carbon::parse($month)->month)
            ->whereYear('created_at',$year)
            ->orderBy('created_at','decs')
            ->paginate(5);

        return view('home',['posts' => $posts]);
    }

    public function postByTags($id){
        $posts = Post::leftJoin('post_tag','posts.id','=','post_tag.post_id')
            ->with('user')
            ->with('category')
            ->with('postMedia')
            ->where('is_published',1)
            ->where('post_tag.tag_id',$id)
            ->orderBy('created_at','decs')
            ->paginate(5);

        return view('home',['posts' => $posts]);
    }

    public function postByUsers($id){
        $posts = Post::with('user')
            ->with('category')
            ->with('postMedia')
            ->where('is_published',1)
            ->where('user_id',$id)
            ->orderBy('created_at','decs')
            ->paginate(5);

        return view('home',['posts' => $posts]);
    }

    public function postByCategory($cat_id){
        $posts = Post::with('user')
            ->with('category')
            ->with('postMedia')
            ->where('is_published',1)
            ->where('category_id',$cat_id)
            ->orderBy('created_at','decs')
            ->paginate(5);

        return view('home',['posts' => $posts]);
    }

    public function singleBlog($post_url){
        $post = Post::with('user')
            ->with('category')
            ->with('postMedia')
            ->with('tags')
            ->where('is_published',1)
            ->where('post_url',$post_url)
            ->first();

        $comments = Comments::with('reply')
            ->where('post_id',$post->id)
            ->get();
        $post->comments = $comments;
        return view('article',['post' => $post]);
    }

    //comments
    public function comment(Request $request,$id){
        $validator = Validator::make($request->all(),[
            'author' => 'required|max:30',
            'email' => 'required',
            'comment' => 'required'
        ]);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
        }

        if(empty($request->input('comment_id'))){
            $post = Post::find($id);
            if (!$post){
                return redirect()->back()->withInput($request->all())->with('error','Post Not Fond');
            }
            $comment = new Comments();
            $comment->author = $request->input('author');;
            $comment->email = $request->input('email');
            $comment->comments = $request->input('comment');

            $post->comments()->save($comment);
        }else{
            $comment = Comments::find($request->input('comment_id'));
            if (!$comment){
                return redirect()->back()->withInput($request->all())->with('error','Comment Not Fond');
            }
            $reply = new Reply();
            $reply->author = $request->input('author');;
            $reply->email = $request->input('email');
            $reply->reply = $request->input('comment');

            $comment->reply()->save($reply);
        }

        return redirect()->back()->with('success','Comment Add Successfully');
    }

}
