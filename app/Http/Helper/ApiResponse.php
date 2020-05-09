<?php


namespace App\Http\Helper;


use App\News;
use App\Sources;
use GuzzleHttp\Client;

class ApiResponse implements ResponsableInterface {

    private $baseUrl = "https://newsapi.org/v2";
    protected $client;
    /**
     * @var DBHelperInterface
     */
    private $helper;

    /**
     * ApiResponse constructor.
     * @param DBHelperInterface $helper
     */
    public function __construct()
    {
        $this->client = new Client();
        $this->helper = new DBHelper();
    }


    public function getByCountry($country)
    {
        if(count(News::where('country', $country)->get()) >0){
            return News::where('country', $country)->get();
        }
        $response = $this->getResponse($country,'/top-headlines');
        $datas = json_decode($response->getBody()->getContents())->articles;
        $this->helper->saveToDatabase($datas, null, null, $country);
        return News::where('country', $country)->get();
    }

    public function getBySources($sources)
    {
        if(count(News::where('source', $sources)->get()) >0){
            return News::where('source', $sources)->get();
        }
        $response = $this->getResponse($sources,'/top-headlines');
        $datas = json_decode($response->getBody()->getContents())->articles;
        $this->helper->saveToDatabase($datas, null, $sources);
        return News::where('source', $sources)->get();

    }

    public function getAll($query)
    {
        if(count(News::where('category', $query)->get())> 0){
            return News::where('category', $query)->get();
        }
        $response = $this->getResponse($query, '/everything');
        $datas = json_decode($response->getBody()->getContents())->articles;
        $this->helper->saveToDatabase($datas, $query);
        return News::where('category', $query)->get();
    }
    public function getValidCountries()
    {
        return $countryList = ['ae', 'ar', 'at', 'au', 'be', 'bg',
            'br', 'ca', 'ch', 'cn', 'co', 'cu', 'cz', 'de', 'eg',
            'fr', 'gb', 'gr', 'hk', 'hu', 'id', 'ie', 'il', 'in',
            'it', 'jp', 'kr', 'lt', 'lv', 'ma', 'mx', 'my', 'ng',
            'nl', 'no', 'nz', 'ph', 'pl', 'pt', 'ro', 'rs', 'ru',
            'sa', 'se', 'sg', 'si', 'sk', 'th', 'tr', 'tw', 'ua',
            'us', 've', 'za'];
    }

    /**
     * @param $queryParams
     * @param $urlLiterals
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Exception
     */
    protected function getResponse($queryParams, $urlLiterals): \Psr\Http\Message\ResponseInterface
    {
        if($urlLiterals == "/sources"){
            try{
                return $this->client->get($this->baseUrl . $urlLiterals, [
                    'query' => [
                        'apiKey' => env('MIX_ApiKey')
                    ]
                ]);
            } catch (\Exception $exception){
                throw $exception;
            }
        }
        if(in_array($queryParams, $this->getValidCountries())){
            return $this->client->get($this->baseUrl . $urlLiterals, [
                'query' => [
                    'country' => $queryParams,
                    'apiKey' => env('MIX_ApiKey')
                ]
            ]);
        }
        if(in_array($queryParams, $this->getSources())){
            return $this->client->get($this->baseUrl . $urlLiterals, [
                'query' => [
                    'sources' => $queryParams,
                    'apiKey' => env('MIX_ApiKey')
                ]
            ]);
        }
         return $this->client->get($this->baseUrl .$urlLiterals, [
            'query' => [
                'apiKey' => env('MIX_ApiKey'),
                'q' => $queryParams
            ]
        ]);
    }
    public function getSources()
    {
        if(count(Sources::all())> 0){
            return Sources::all();
        }
        $response = $this->getResponse(null,'/sources');
        $sources = json_decode($response->getBody()->getContents())->sources;
        $helper = new DBHelper();
        $helper->saveSources($sources);
        dd(Sources::all());
        return Sources::all();
    }
}
