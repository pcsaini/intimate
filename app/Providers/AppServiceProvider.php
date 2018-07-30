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
            $category = Category::where('is_active',1)->get();
            $tags = Tag::has('posts')->get();
            foreach ($tags as $tag){
                $class = array_random(['medium','large','medium']);
                $tag->class = $class;
            }
            $view->with('archives',$post->archives())
                ->with('category',$category)
                ->with('tags',$tags);
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
