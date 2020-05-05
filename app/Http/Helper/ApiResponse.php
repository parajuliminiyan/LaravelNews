<?php


namespace App\Http\Helper;


use App\News;
use GuzzleHttp\Client;

class ApiResponse implements ResponsableInterface {

    private $baseUrl = "https://newsapi.org/v2";
    protected $client;

    /**
     * ApiResponse constructor.
     * @param string $baseUrl
     */
    public function __construct()
    {
        $this->client = new Client();
    }


    public function getByCountry($country)
    {
        $response = $this->client->get($this->baseUrl."/top-headlines", [
            'query' => [
                    'country' => $country,
                    'apiKey' => env('MIX_ApiKey')
                ]
        ]);
        if($response->getStatusCode() >=200 && $response->getStatusCode() < 300){
            return json_decode($response->getBody()->getContents())->articles;
        }
        return $response->getBody()->getContents();
    }

    public function getBySources($sources)
    {
        $response = $this->client->get($this->baseUrl."/top-headlines", [
            'query' => [
                'sources' => $sources,
                'apiKey' => env('MIX_ApiKey')
            ]
        ]);
        if($response->getStatusCode() >=200 && $response->getStatusCode() < 300){
            return json_decode($response->getBody()->getContents())->articles;
        }
        return $response->getBody()->getContents();

    }

    public function getAll($query)
    {
        $response = $this->client->get($this->baseUrl."/everything",[
            'query' => [
                'apiKey' => env('MIX_ApiKey'),
                'q' => $query
            ]
        ]);
        $datas = json_decode($response->getBody()->getContents())->articles;
        foreach ($datas as $data)
        {
            News::create([
                'title'=> $data->title,
                'author' => $data->author,
                'description' => $data->description,
                'url' => $data->url,
                'imageUrl' => $data->urlToImage,
                'publishedAt' => $data->publishedAt,
                'content' => $data->content,
                'category' => $query
            ]);
        }
        return News::where('category', $query)->get();


    }

    public  function getSources()
    {
        $response = $this->client->get($this->baseUrl."/sources",[
            'query' => [
                'apiKey' => env('MIX_ApiKey')
            ]
        ]);
        return json_decode($response->getBody()->getContents())->sources;
    }
}
