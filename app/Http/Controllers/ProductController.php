<?php

namespace App\Http\Controllers;

use App\Services\GuzzleService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $guzzleService;

    public function __construct(GuzzleService $guzzleService)
    {
        $this->guzzleService = $guzzleService;
        $this->guzzleService->setHost(url('/'));
    }


    public function index()
    {
        $url    = route('products.list');
        $result = $this->guzzleService->getGuzzleRequest($url);
        if ($result['status']['http_code'] == 200) {
            return view('shop.show-shop')->with('products', $result['data']['products']);
        }

        return view('shop.show-shop')->with('products', []);
    }

    public function show($slug)
    {
        $url    = route('product.show', $slug);
        $result = $this->guzzleService->getGuzzleRequest($url);
        if ($result['status']['http_code'] == 200 && !empty($result['data']['product'])) {
            return view('shop.show-product')->with('product', $result['data']['product']);
        }

        return view('shop.show-product')->with('product', []);
    }
}
