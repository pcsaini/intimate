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
/*Route::name('admin.')->middleware('is_admin:1')->prefix('admin')->group(function (){
    Route::get('dashboard','AdminController@getDashboard')->name('dashboard');
    Route::get('users','AdminController@getUsers')->name('get_users');
});*/


//User Routes
Route::name('user.')->middleware('auth')->prefix('user')->group(function (){
    Route::get('dashboard','UserController@getDashboard')->name('dashboard');
    Route::get('posts','AdminController@getPosts')->name('get_posts');
    Route::get('comments','AdminController@getComments')->name('get_comments');
    Route::get('add_new_post','AdminController@getAddNewPost')->name('get_add_new_post');
    Route::get('profile','AdminController@getProfile')->name('get_profile');
});
