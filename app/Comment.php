<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected  $fillable=[
      'content',
        'date_written',
        'user_id',
        'post_id'
    ];

    public  function  Post(){
        return $this ->belongsTo(Post::class);
    }

    public  function author(){
        return $this-> belongsTo(User::class);
    }

    public  function category(){
        return $this->belongsTo(Category::class);
    }


    //
}
