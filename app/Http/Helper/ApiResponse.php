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
        $response = $this->client->get($this->baseUrl . "/top-headlines", [
            'query' => [
                'country' => $country,
                'apiKey' => env('MIX_ApiKey')
            ]
        ]);
        $datas = json_decode($response->getBody()->getContents())->articles;
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
                'country' => $country
            ]);
        }
        return News::where('country', $country)->get();
    }

    public function getBySources($sources)
    {
        $response = $this->client->get($this->baseUrl . "/top-headlines", [
            'query' => [
                'sources' => $sources,
                'apiKey' => env('MIX_ApiKey')
            ]
        ]);
        $datas = json_decode($response->getBody()->getContents())->articles;
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
                'source' => $sources
            ]);
        }
        return News::where('source', $sources)->get();

    }

    public function getAll($query)
    {
        $response = $this->client->get($this->baseUrl . "/everything", [
            'query' => [
                'apiKey' => env('MIX_ApiKey'),
                'q' => $query
            ]
        ]);
        $datas = json_decode($response->getBody()->getContents())->articles;
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
                'category' => $query,
                'source' => $data->source->id
            ]);
        }
        return News::where('category', $query)->get();


    }

    public function getSources()
    {
        $response = $this->client->get($this->baseUrl . "/sources", [
            'query' => [
                'apiKey' => env('MIX_ApiKey')
            ]
        ]);
        return json_decode($response->getBody()->getContents())->sources;
    }

    public function getValidCountries()
    {
        return $countryList = ['ae', 'ar', 'at', 'au', 'be', 'bg',
            'br', 'ca', 'ch', 'cn', 'co', 'cu', 'cz', 'de', 'eg', 'fr', 'gb', 'gr', 'hk', 'hu',
            'id', 'ie', 'il', 'in', 'it', 'jp', 'kr', 'lt', 'lv', 'ma', 'mx',
            'my', 'ng',
            'nl',
            'no', 'nz', 'ph', 'pl',
            'pt', 'ro', 'rs', 'ru', 'sa', 'se', 'sg', 'si', 'sk', 'th', 'tr', 'tw', 'ua', 'us', 've', 'za'];
    }
}
