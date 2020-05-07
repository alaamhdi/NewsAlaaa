<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected  $fillable =[
        'title','content','date_written','featured_image','voted_up','voted_down','user_id',
        'Category_id'

    ];

    public  function  author(){
        return $this ->belongsTo(User::class,'user_id','id');
    }

    public  function  comments(){
        return $this ->hasMany(Comment::class);
    }

    public  function  category(){
        return $this ->belongsTo(Category::class,'Category_id','id');
    }
    //
}
