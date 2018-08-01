<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comments;
use App\Post;
use App\PostMedia;
use App\Reply;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getDashboard(){
        $posts = Post::where('is_published',1)->count();
        $users = User::count();
        $category = Category::where('is_active',1)->count();
        $comments = Comments::count();
        $reply = Reply::count();
        $last_post = Post::whereDate('created_at', '>', \Carbon\Carbon::now()->subDay())
            ->count();
        $last_user = User::whereDate('created_at', '>', \Carbon\Carbon::now()->subDay())
            ->count();
        $last_comments = Comments::whereDate('created_at', '>', \Carbon\Carbon::now()->subDay())
            ->count();
        $data = [
            'posts' => $posts,
            'users' =>$users,
            'comments' => $comments + $reply,
            'category' => $category,
            'last_comments' => $last_comments,
            'last_post' => $last_post,
            'last_user' => $last_user
        ];
        return view('super.dashboard',['data' => $data]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUsers(){
        return view('super.users');
    }

    /**
     * @param Request $request
     */
    public function users(Request $request){
        $columns  = array(
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'status',
            4 => 'id',
        );

        $totalData = User::count();
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value'))){
            $users = User::offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
        }else{
            $search = $request->input('search.value');
            $users = User::where('name','LIKE','%'.$search.'%')
                ->orWhere('email','LIKE','%'.$search.'%')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();

            $totalFiltered = User::where('name','LIKE','%'.$search.'%')
                ->orWhere('email','LIKE','%'.$search.'%')->count();
        }

        $data = array();

        if(!empty($users)) {
            foreach ($users as $user) {
                $delete = route('super.delete_user',$user->id);
                $approve = route('super.approve_user',$user->id);

                $nestedData['id'] = $user->id;
                $nestedData['name'] = $user->name;
                $nestedData['email'] = $user->email;
                $nestedData['status'] = $user->is_active == 0 ? "<a href='{$approve}' class='btn btn-primary'>Active</a>" : "<span class='text-primary'><b>Activate</b></span>";
                $nestedData['options'] = $user->is_delete == 0 ? "<a href='{$delete}' class='btn btn-danger'>Delete</a>" : "<span class='text-danger'><b>Deleted</b></span>";
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approveUser($id){
        $user = User::where('is_active',0)->find($id);
        if (!$user){
            return redirect()->back()->with('error','User Not Find');
        }

        $user->is_active = 1;
        $result = $user->save();
        if (!$result){
            return redirect()->back()->with('error', 'Problem to Active User');
        }

        return redirect()->back()->with('success','User Active Successfully');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteUser($id){
        $user = User::where('is_active',1)->where('is_delete',0)->find($id);
        if (!$user){
            return redirect()->back()->with('error','User Not Find');
        }

        $user->is_delete = 1;
        $result = $user->save();
        if (!$result){
            return redirect()->back()->with('error', 'Problem to Delete User');
        }

        return redirect()->back()->with('success','User Delete Successfully');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAddUser(){
        return view('super.add_user');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveUser(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:20',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6|max:20',
            'confirm_password' => 'required|same:password'
        ]);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
        }
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = bcrypt($password);
        $user->is_active = 1;
        $result = $user->save();

        if (!$result){
            return redirect()->back()->with('error','Problem to Create User')->withInput($request->all());
        }

        return redirect()->route('super.get_users')->with('success','User Created Successfully');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCategory(){
        $category = Category::get();
        return view('super.category',['category' => $category]);
    }

    /**
     * @param Request $request
     */
    public function category(Request $request){
        $columns  = array(
            0 => 'id',
            1 => 'category',
            2 => 'status',
            3 => 'id',
        );

        $totalData = Category::count();
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value'))){
            $category = Category::offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
        }else{
            $search = $request->input('search.value');
            $category = Category::where('category','LIKE','%'.$search.'%')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();

            $totalFiltered = Category::where('category','LIKE','%'.$search.'%')->count();
        }

        $data = array();

        if(!empty($category)) {
            foreach ($category as $cat) {
                $edit = route('super.edit_category',$cat->id);
                $delete = route('super.delete_category',$cat->id);
                $approve = route('super.approve_category',$cat->id);

                $nestedData['id'] = $cat->id;
                $nestedData['category'] = $cat->category;
                $nestedData['status'] = $cat->is_active == 0 ? "<a href='{$approve}' class='btn btn-primary'>Active</a>" : "<span class='text-primary'><b>Activate</b></span>";
                $nestedData['options'] = "<a href='{$edit}' title='Edit' ><span class='glyphicon glyphicon-edit text-primary'></span></a> &nbsp; <a href='{$delete}' title='Delete' ><span class='glyphicon glyphicon-trash text-danger'></span></a>";
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAddCategory(){
        $category = [];
        return view('super.add_category',['category' => $category]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editCategory($id){
        $category = Category::find($id);
        return view('super.add_category',['category' => $category]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveCategory(Request $request){
        $validator = Validator::make($request->all(),[
            'category' => 'required|unique:category,category|max:20'
        ]);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
        }
        $id = $request->input('id');
        $category_name = $request->input('category');

        if ($id == 0){
            $category = new Category();
            $category->category = $category_name;
            $category->is_active = 1;
            $result = $category->save();
        }else{
            $category = Category::find($id);
            $category->category = $category_name;
            $result = $category->save();
        }

        if (!$request){
            return redirect()->back()->with('error','Problem to Save Category')->withInput($request->all());
        }
        return redirect()->route('super.get_category')->with('success','Category Add Successfully');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approveCategory($id){
        $category = Category::find($id);
        if (!$category){
            return redirect()->back()->with('error','Category Not Found');
        }
        $category->is_active = 1;
        $result = $category->save();
        if (!$result){
            return redirect()->back()->with('error','Problem to Active Category');
        }

        return redirect()->back()->with('success','Category Active Successfully');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteCategory($id){
        $category = Category::find($id);
        if (!$category){
            return redirect()->back()->with('error','Category Not Found');
        }
        $result = $category->delete();
        if (!$result){
            return redirect()->back()->with('error','Problem to Delete Category');
        }

        return redirect()->back()->with('success','Category Delete Successfully');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPosts(){
        return view('super.posts');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAddPost(){
        $category = Category::where('is_active',1)->get();
        return view('super.add_post',['category' => $category]);
    }

    /**
     * @param Request $request
     */
    public function posts(Request $request){
        $columns  = array(
            0 => 'id',
            1 => 'post_title',
            2 => 'category_id',
            3 => 'id',
            4 => 'status',
            5 => 'id',
            6 => 'id',
        );

        $totalData = Post::count();
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value'))){
            $posts = Post::with('tags')
                ->with('category')
                ->with('postMedia')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
        }else{
            $search = $request->input('search.value');
            $posts = Post::with('tags')
                ->with('category')
                ->with('postMedia')
                ->where('post_title','LIKE','%'.$search.'%')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();

            $totalFiltered = Post::where('post_title','LIKE','%'.$search.'%')->count();
        }
        $data = array();

        if(!empty($posts)) {
            foreach ($posts as $post) {
                $edit = route('super.edit_post',$post->id);
                $delete = route('super.delete_post',$post->id);
                $approve = route('super.publish_post',$post->id);
                $comment = route('super.get_comments',$post->id);

                $tags = [];
                foreach ($post->tags as $tag){
                    $tags[] = $tag->name;
                }
                $tags = implode(',',$tags);

                $nestedData['id'] = $post->id;
                $nestedData['post_title'] = $post->post_title;
                $nestedData['post_category'] = $post->category->category;
                $nestedData['post_tags'] = $tags;
                $nestedData['status'] = $post->is_published == 0 ? "<a href='{$approve}' class='btn btn-primary'>Publish</a>" : "<span class='text-primary'><b>Published</b></span>";
                $nestedData['options'] = "<a href='{$edit}' title='Edit' ><span class='glyphicon glyphicon-edit text-primary'></span></a> &nbsp; <a href='{$delete}' title='Delete' ><span class='glyphicon glyphicon-trash text-danger'></span></a>";
                $nestedData['comments'] = "<a href='{$comment}' class='btn btn-info'>Comments</a>";
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editPost($id){
        $post = Post::with('tags')->find($id);
        $tags = [];
        foreach ($post->tags as $tag){
            $tags[] = $tag->name;
        }
        $tags = implode(',',$tags);
        unset($post->tags);
        $post->tags = $tags;
        $category = Category::where('is_active',1)->get();
        return view('super.add_post',['post' => $post,'category' => $category]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deletePost($id){
        $post = Post::with('tags')
            ->with('postMedia')
            ->find($id);
        if (!$post){
            return redirect()->back()->with('error', 'Post Not Found');
        }

        foreach ($post->tags as $tag){
            $post->tags()->detach($tag);
        }

        foreach ($post->postMedia as $post_media){
            $post->postMedia()->delete($post_media);
        }

        $post->delete();
        return redirect()->back()->with('success','Post Successfully Deleted');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function publishPost($id){
        $post = Post::find($id);
        if (!$post){
            return redirect()->back()->with('error', 'Post Not Found');
        }
        $post->is_published = 1;
        $post->save();

        return redirect()->back()->with('success','Post Successfully Published');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function savePost(Request $request){
        $user_id = Auth::id();
        $user = User::find($user_id);
        $validator = Validator::make($request->all(),[
            'post_title' => 'required|min:6|max:191',
            'category' => 'required',
            'tags' => 'required',
            'post' => 'required',
        ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->errors())->with($request->all());
        }
        $post_model = new Post();
        $post_title = $request->input('post_title');
        $post_url = $post_model->urlEncode($post_title);
        $post_category = $request->input('category');
        $post_tags = $request->input('tags');
        $tags = explode(',',$post_tags);
        $post_content = $request->input('post');

        if ($request->input('id') == 0){
            $post = new Post();
            $post->post_title = $post_title;
            $post->post_url = $post_url;
            $post->category_id = $post_category;
            $post->post = $post_content;

            if ($request->input('publish')){
                $post->is_published = 1;
            }else{
                $post->is_published = 0;
            }
            $user->posts()->save($post);

            foreach ($tags as $tag){
                $tagModel = Tag::where('name',$tag)->first();
                if (!$tagModel){
                    $tagModel = new Tag();
                    $tagModel->name = $tag;
                    $tagModel->save();
                }
                $post_tag = DB::table('post_tag')->where('post_id',$post->id)->where('tag_id',$tagModel->id)->first();
                if (!$post_tag){
                    $post->tags()->attach($tagModel);
                }
            }

            if ($request->hasFile('post_media')){
                $files = $request->file('post_media');
                $num = 0;
                foreach ($files as $file){
                    $num++;
                    $extension = $file->getClientOriginalExtension();
                    $name = str_limit($post_url,10).'n-'.$num.'.'.$extension;
                    $file->move(public_path().'/post_media/', $name);

                    $post_media = new PostMedia();
                    $post_media->media = $name;
                    $post->postMedia()->save($post_media);
                }
            }

        }else{
            $post = Post::find($request->input('id'));
            $post->post_title = $post_title;
            $post->post_url = $post_url;
            $post->category_id = $post_category;
            $post->post = $post_content;
            $user->posts()->save($post);

            foreach ($tags as $tag){
                $tagModel = Tag::where('name',$tag)->first();
                if (!$tagModel){
                    $tagModel = new Tag();
                    $tagModel->name = $tag;
                    $tagModel->save();
                }
                $post_tag = DB::table('post_tag')->where('post_id',$post->id)->where('tag_id',$tagModel->id)->first();
                if (!$post_tag){
                    $post->tags()->attach($tagModel);
                }

            }

            if ($request->hasFile('post_media')){
                $files = $request->file('post_media');
                $num = 0;
                foreach ($files as $file){
                    $num++;
                    $extension = $file->getClientOriginalExtension();
                    $name = str_limit($post_url,10).'edit-'.$num.'.'.$extension;
                    $file->move(public_path().'/post_media/', $name);

                    $post_media = new PostMedia();
                    $post_media->media = $name;
                    $post->postMedia()->save($post_media);
                }
            }
        }

        return redirect()->route('super.get_posts')->with('success','Post Successfully Created');

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getComments($id){
        return view('super.comments',['post_id' => $id]);
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function comments(Request $request, $id){
        $columns  = array(
            0 => 'author',
            1 => 'email',
            2 => 'comments',
            3 => 'id',
            4 => 'id'
        );

        $totalData = Comments::where('post_id',$id)->count();
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value'))){
            $comments = Comments::where('post_id',$id)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
        }else{
            $search = $request->input('search.value');
            $comments = Comments::where('post_id',$id)
                ->where('comments','LIKE','%'.$search.'%')
                ->orWhere('name','LIKE','%'.$search.'%')
                ->orWhere('email','LIKE','%'.$search.'%')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();

            $totalFiltered = Comments::where('post_id',$id)
                ->where('comments','LIKE','%'.$search.'%')
                ->orWhere('name','LIKE','%'.$search.'%')
                ->orWhere('email','LIKE','%'.$search.'%')
                ->count();
        }

        $data = array();

        if(!empty($comments)) {
            foreach ($comments as $comment) {
                $delete = route('super.delete_comment',$comment->id);
                $reply = route('super.get_reply',$comment->id);

                $nestedData['author'] = $comment->author;
                $nestedData['email'] = $comment->email;
                $nestedData['comments'] = $comment->comments;
                $nestedData['reply'] = "<a href='{$reply}' class='btn btn-info'>Reply</a>";
                $nestedData['options'] = "<a href='{$delete}' title='Delete' ><span class='glyphicon glyphicon-trash text-danger'></span></a>";
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteComment($id){
        $comment = Comments::find($id);
        if (!$comment){
            return redirect()->back()->with('error','Reply Not Found');
        }
        $delete = Reply::where('comment_id',$id)->delete();
        if ($delete) {
            $result = $comment->delete();

            if (!$result) {
                return redirect()->back()->with('error', 'Problem to Delete Reply');
            }
        }else{
            return redirect()->back()->with('error', 'Problem to Delete Reply');
        }

        return redirect()->back()->with('success','Reply Delete Successfully');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getReply($id){
        return view('super.reply',['comment_id' => $id]);
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function reply(Request $request, $id){
        $columns  = array(
            0 => 'author',
            1 => 'email',
            2 => 'reply',
            3 => 'id',
        );

        $totalData = Reply::where('comment_id',$id)->count();
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value'))){
            $replies = Reply::where('comment_id',$id)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
        }else{
            $search = $request->input('search.value');
            $replies = Reply::where('comment_id',$id)
                ->where('reply','LIKE','%'.$search.'%')
                ->orWhere('name','LIKE','%'.$search.'%')
                ->orWhere('email','LIKE','%'.$search.'%')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();

            $totalFiltered = Reply::where('comment_id',$id)
                ->where('reply','LIKE','%'.$search.'%')
                ->orWhere('name','LIKE','%'.$search.'%')
                ->orWhere('email','LIKE','%'.$search.'%')
                ->count();
        }

        $data = array();

        if(!empty($replies)) {
            foreach ($replies as $reply) {
                $delete = route('super.delete_reply',$reply->id);

                $nestedData['author'] = $reply->author;
                $nestedData['email'] = $reply->email;
                $nestedData['reply'] = $reply->reply;
                $nestedData['options'] = "<a href='{$delete}' title='Delete' ><span class='glyphicon glyphicon-trash text-danger'></span></a>";
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteReply($id){
        $reply = Reply::find($id);
        if (!$reply){
            return redirect()->back()->with('error','Reply Not Found');
        }
        $result = $reply->delete();
        if (!$result){
            return redirect()->back()->with('error','Problem to Delete Reply');
        }

        return redirect()->back()->with('success','Reply Delete Successfully');
    }

    public function getProfile(){
        $user = Auth::user();
        return view('super.profile',['user' => $user]);
    }

    public function profile(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
        ]);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
        }

        $user = User::find(Auth::id());
        $user->name = $request->input('name');
        $user->bio = $request->input('bio');
        $user->facebook_url = $request->input('facebook_url');
        $user->twitter_url = $request->input('twitter_url');
        $user->google_plus_url = $request->input('google_plus_url');
        $user->instagram_url = $request->input('instagram_url');
        $user->linkedin_url = $request->input('linkedin_url');

        if ($request->hasFile('profile_pic')){
            $file = $request->file('profile_pic');
            $extension = $file->getClientOriginalExtension();
            $name = str_random(15).'.'.$extension;
            $file->move(public_path().'/profile_pic/', $name);

            $user->profile_pic = $name;
        }else{
            $user->profile_pic = 'profile_pic.png';
        }

        $user->save();

        return redirect()->back()->with('success','Update Successfully');
    }
}
