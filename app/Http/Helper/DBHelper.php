<?php


namespace App\Http\Helper;


use App\News;
use App\Sources;

class DBHelper implements DBHelperInterface {

    public function saveToDatabase($datas, $category = null, $source = null, $country = null): void
    {
        foreach ($datas as $data)
        {
            News::create([
                'title' => $data->title,
                'author' => $data->author,
                'description' => $data->description,
                'url' => $data->url,
                'imageUrl' => $data->urlToImage,
                'publishedAt' => $data->publishedAt,
                'content' => $data->content,
                'category' => $category,
                'source' => $source !== null ? $source : $data->source->id,
                'country' => $country,
            ]);
        }
    }

    public function saveSources($sources)
    {
        foreach ($sources as $source){
            Sources::create([
               'news_id' => $source->id,
                'name' => $source->name,
                'description' => $source->description,
                'url' => $source->url,
                'category' => $source->category,
                'language' => $source->language,
                'country' => $source->country
            ]);
        }
    }
}
