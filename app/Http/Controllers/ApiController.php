<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Config;


class ApiController extends Controller
{
    protected $end_point;
    protected $api_key;
    protected $password;
    protected $client;

    public function __construct()
    {
        $this->api_key   =  Config::get('services.shopify.api_key');
        $this->password  = Config::get('services.shopify.password');
        $this->end_point = 'https://' . $this->api_key . ':' . $this->password . Config::get('services.shopify.base_url');
        $this->client    = new Client();
    }

}
