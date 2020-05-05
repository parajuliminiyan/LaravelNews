<?php

namespace App\Providers;

use App\Http\Helper\ApiResponse;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $apiResponse = new ApiResponse();
        \View::share('sources', $apiResponse->getSources());
        \View::share('countries', $apiResponse->getValidCountries());
    }
}
