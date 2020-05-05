<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    protected $guarded = [];

    public function news()
    {
        return $this->belongsTo(News::class)->first();
    }

    public function user()
    {
        return $this->belongsTo(User::class)->first();
    }
}
