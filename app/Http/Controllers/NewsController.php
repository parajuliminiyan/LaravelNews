<?php

namespace App\Http\Controllers;

use App\Http\Helper\ApiResponse;
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
}
