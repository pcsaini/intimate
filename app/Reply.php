<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    //
    protected $table = 'reply';

    public function comment(){
        return $this->belongsTo(Comments::class,'comment_id');
    }

}
