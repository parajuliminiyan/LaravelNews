<?php

namespace App\Http\Controllers;

use App\Http\Helper\ApiResponse;
use App\Likes;
use App\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{

    public function getAllData()
    {  $response = new ApiResponse();
        $response = $response->getAll('technology');
        return view('home', compact('response'));
    }

    public function index($source)
    {
        $response = new ApiResponse();
        $response = $response->getBySources($source);
        return view('newsBySource', compact('response'));

    }


    public function details($id)
    {
        $news = News::findorFail($id);
        return view('news.show', compact('news'));
    }

    public function country($country)
    {
        $response = new ApiResponse();
        $newsDatas = $response->getByCountry($country);
        return view('news.country', compact('newsDatas'));
    }

    public function like()
    {
        $news_id = \request('id');

        if($this->hasLiked($news_id) !== false){
            $like = $this->hasLiked($news_id);
            $like->type = 'like';
            $like->save();
        }else{
            $like = new Likes();
            $like->user_id = auth()->id();
            $like->news_id = $news_id;
            $like->type = 'like';
            $like->save();
        }
        return redirect()->back();
    }

    public function dislike()
    {
        $news_id = \request('id');

        if($this->hasLiked($news_id) !== false){
            $like = $this->hasLiked($news_id);
            $like->type = 'dislike';
            $like->save();
        }else{
            $like = new Likes();
            $like->user_id = auth()->id();
            $like->news_id = $news_id;
            $like->type = 'dislike';
            $like->save();
        }
        return redirect()->back();
    }

    /**
     * @param $news_id
     * @return mixed
     */
    protected function hasLiked($news_id)
    {
        $likes =  Likes::where('news_id', $news_id)->where('user_id', auth()->user()->id)->first();
        return ( $likes ) ? $likes : false;
    }

}
