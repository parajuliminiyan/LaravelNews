<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $guarded= [];
    public function Likes()
    {
        return $this->hasMany(Likes::class);
    }

    public  function getCategoty()
    {
        return $this->category;
    }
}
