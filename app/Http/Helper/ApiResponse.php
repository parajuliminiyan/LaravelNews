<?php


namespace App\Http\Helper;


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

    }

    public function getAll($query)
    {
        $response = $this->client->get($this->baseUrl."/everything",[
            'query' => [
                'apiKey' => env('MIX_ApiKey'),
                'q' => $query
            ]
        ]);
        return json_decode($response->getBody()->getContents())->articles;
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
