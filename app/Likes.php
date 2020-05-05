<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    protected $guarded = [];

    public function News()
    {
        return $this->belongsTo(News::class);
    }
}
