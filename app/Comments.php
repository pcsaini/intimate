<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    //
    protected $table = 'comments';

    public function post(){
        return $this->belongsTo(Post::class,'post_id');
    }

    public function reply(){
        return $this->hasMany(Reply::class,'comment_id');
    }


}
