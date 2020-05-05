<?php

namespace App\Http\Controllers;

use App\Http\Helper\ApiResponse;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       $response = new ApiResponse();
       $response = $response->getAll('technology');
       return view('home', compact('response'));
    }
}
