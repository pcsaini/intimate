<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostMedia extends Model
{
    //
    protected $table = 'post_media';

    public function post(){
        return $this->belongsTo(Post::class,'post_id');
    }

}
