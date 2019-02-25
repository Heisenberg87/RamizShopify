<?php

namespace App\Http\Controllers;

use App\Variant;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;

class VariantsController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function fetchVariants()
    {
        $url = $this->end_point . 'variants.json';

        try {
            $request =$this->client->get($url)->getBody()
                ->getContents();

            $response = json_decode($request);

            return redirect('variants.index')->with('success', 'You have successfully retrived variant records');

        } catch (ClientException $e) {

            $resonse = json_decode($e->getResponse()->getBody()->getContents());
            return redirect('/variants')->with('error', $response);
        }

    }
}
