<?php

namespace App\Providers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength('191');

        view()->composer('layouts.sidebar',function ($view){
            $post = new Post();

            //get archives
            $archives = $post->archives();

            //get category list
            $category = Category::where('is_active',1)->get();

            //get tags list
            $tags = $post->tagsList();

            //get latest posts
            $latest_posts = $post->latestPosts();

            //get popular posts
            $popular_posts = $post->popularPosts();

            $view->with('archives',$archives)
                ->with('category',$category)
                ->with('tags',$tags)
                ->with('latest_posts',$latest_posts)
                ->with('popular_posts',$popular_posts);
        });

        view()->composer('layouts.header',function ($view){
            $category = Category::where('is_active',1)->get();
            $view->with('category',$category);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
