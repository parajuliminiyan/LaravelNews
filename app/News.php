<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $guarded= [];
    public function likes()
    {
        return $this->hasMany(Likes::class);
    }

    public function getLikes()
    {
        return $this->hasMany(Likes::class,'news_id','id')->where('type','like')->get();
    }

    public function getDisLikes()
    {
        return $this->hasMany(Likes::class,'news_id','id')->where('type','dislike')->get();
    }



    public function countLike($newsId)
    {
        return count(Likes::where('news_id', $newsId)->get());
    }
}
