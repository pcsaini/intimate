<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Common Routes
Route::get('register','AuthController@get_register')->name('get_register');
Route::post('register','AuthController@register')->name('register');
Route::get('login','AuthController@get_login')->name('get_login');
Route::post('login','AuthController@login')->name('login');
Route::get('activate_account/{token}','AuthController@activate_account')->name('activate_account');
Route::get('forgot_password','AuthController@get_forgot_password')->name('get_forgot_password');
Route::post('forgot_password','AuthController@forgot_password')->name('forgot_password');
Route::get('reset_password/{token}','AuthController@reset_password')->name('reset_password');
Route::post('update_password','AuthController@update_password')->name('update_password');
Route::get('logout','AuthController@logout')->name('logout');


//Admin Routes
Route::name('super.')->middleware('is_admin:1')->prefix('super')->group(function (){
    Route::get('dashboard','AdminController@getDashboard')->name('dashboard');

    //Users
    Route::get('users','AdminController@getUsers')->name('get_users');
    Route::post('users','AdminController@users')->name('users');
    Route::get('approve_user/{id}','AdminController@approveUser')->name('approve_user');
    Route::get('delete_user/{id}','AdminController@deleteUser')->name('delete_user');
    Route::get('add_user','AdminController@getAddUser')->name('get_add_user');
    Route::post('save_user','AdminController@saveUser')->name('save_user');

    //Category
    Route::get('category','AdminController@getCategory')->name('get_category');
    Route::post('category','AdminController@category')->name('category');
    Route::get('edit_category/{id}','AdminController@editCategory')->name('edit_category');
    Route::get('approve_category/{id}','AdminController@approveCategory')->name('approve_category');
    Route::get('delete_category/{id}','AdminController@deleteCategory')->name('delete_category');
    Route::get('add_category','AdminController@getAddCategory')->name('get_add_category');
    Route::post('save_category','AdminController@saveCategory')->name('save_category');

    //Post
    Route::get('posts','AdminController@getPosts')->name('get_posts');
    Route::post('posts','AdminController@posts')->name('posts');
    Route::get('edit_post/{id}','AdminController@editPost')->name('edit_post');
    Route::get('delete_post/{id}','AdminController@deletePost')->name('delete_post');
    Route::get('publish_post/{id}','AdminController@publishPost')->name('publish_post');
    Route::get('add_post','AdminController@getAddPost')->name('get_add_post');
    Route::post('save_post','AdminController@savePost')->name('save_post');

    //Comments
    Route::get('posts/{id}/comments','AdminController@getComments')->name('get_comments');
    Route::post('posts/{id}/comments','AdminController@comments')->name('comments');
    Route::get('edit_comment/{id}','AdminController@editComments')->name('edit_comment');
    Route::get('delete_comment/{id}','AdminController@deleteComments')->name('delete_comment');
    Route::get('posts/{id}/add_comment','AdminController@getAddComments')->name('get_add_comment');
    Route::post('save_comment','AdminController@saveComments')->name('save_comments');

    //Replies
    Route::get('comments/{id}/reply','AdminController@getReply')->name('get_reply');
    Route::post('comments/{id}/reply','AdminController@reply')->name('reply');
    Route::get('edit_reply/{id}','AdminController@editReply')->name('edit_reply');
    Route::get('delete_reply/{id}','AdminController@deleteReply')->name('delete_reply');
    Route::get('comments/{id}/add_reply','AdminController@getAddReply')->name('get_add_reply');
    Route::post('save_reply','AdminController@saveReply')->name('save_reply');

    //Profile
    Route::get('profile','AdminController@getProfile')->name('get_profile');
    Route::post('profile','AdminController@profile')->name('profile');
});


//User Routes
Route::name('user.')->middleware('auth')->prefix('user')->group(function (){
    Route::get('dashboard','UserController@getDashboard')->name('dashboard');

    //Category
    Route::get('category','UserController@getCategory')->name('get_category');
    Route::post('category','UserController@category')->name('category');
    Route::get('add_category','UserController@getAddCategory')->name('get_add_category');
    Route::post('save_category','UserController@saveCategory')->name('save_category');

    //Post
    Route::get('posts','UserController@getPosts')->name('get_posts');
    Route::post('posts','UserController@posts')->name('posts');
    Route::get('edit_post/{id}','UserController@editPost')->name('edit_post');
    Route::get('delete_post/{id}','UserController@deletePost')->name('delete_post');
    Route::get('publish_post/{id}','UserController@publishPost')->name('publish_post');
    Route::get('add_post','UserController@getAddPost')->name('get_add_post');
    Route::post('save_post','UserController@savePost')->name('save_post');


    //Comments
    Route::get('posts/{id}/comments','UserController@getComments')->name('get_comments');
    Route::post('posts/{id}/comments','UserController@comments')->name('comments');
    Route::get('edit_comment/{id}','UserController@editComments')->name('edit_comment');
    Route::get('delete_comment/{id}','UserController@deleteComment')->name('delete_comment');
    Route::get('posts/{id}/add_comment','UserController@getAddComments')->name('get_add_comment');
    Route::post('save_comment','UserController@saveComments')->name('save_comments');

    //Replies
    Route::get('comments/{id}/reply','UserController@getReply')->name('get_reply');
    Route::post('comments/{id}/reply','UserController@reply')->name('reply');
    Route::get('edit_reply/{id}','UserController@editReply')->name('edit_reply');
    Route::get('delete_reply/{id}','UserController@deleteReply')->name('delete_reply');
    Route::get('comments/{id}/add_reply','UserController@getAddReply')->name('get_add_reply');
    Route::post('save_reply','UserController@saveReply')->name('save_reply');

    //Profile
    Route::get('profile','UserController@getProfile')->name('get_profile');
    Route::post('profile','UserController@profile')->name('profile');
});


//Blog
Route::name('blog.')->group(function (){
    Route::get('/','BlogController@posts')->name('posts');
    Route::get('/posts/category/{id}/{category}','BlogController@postByCategory')->name('post_by_category');
    Route::get('/posts/archives/{month}/{year}','BlogController@postByArchives')->name('post_by_archives');
    Route::get('/posts/tag/{id}/{tag}','BlogController@postByTags')->name('post_by_tags');
    Route::get('/posts/user/{id}/{user}','BlogController@postByUsers')->name('post_by_users');
    Route::get('/post/{post_url}','BlogController@singleBlog')->name('single_blog');
    Route::post('/post/{id}/comment','BlogController@comment')->name('comment');
});
