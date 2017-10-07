<?php

namespace App\Http\Controllers\API;

use App\Repositories\Product\ProductInterface;
use App\Services\GuzzleService;
use Illuminate\Http\Request;

class ProductAPIController extends BaseController
{
    protected $productRepo;
    protected $guzzleService;

    public function __construct(ProductInterface $productRepo, GuzzleService $guzzleService)
    {
        $this->productRepo = $productRepo;
        $this->guzzleService = $guzzleService;
    }

    public function getProducts()
    {
        $data     = [];
        $statusCode = 200;
        $response = [
            'success' => true,
            'message' => 'Products List',
        ];
        try {
            $data['products'] = $this->productRepo->getAll();
        } catch (\Exception $e) {
            $statusCode = 500;
        }

        return $this
            ->setStatusCode($statusCode)
            ->setDataBag($data)
            ->respond($response);
    }

    public function getProduct($slug)
    {
        $data     = [];
        $statusCode = 200;
        $response = [
            'success' => true,
            'message' => 'Product Information',
        ];
        try {
            $data['product'] = $this->productRepo->findSlug($slug);
        } catch (\Exception $e) {
            $statusCode = 500;
        }

        return $this
            ->setStatusCode($statusCode)
            ->setDataBag($data)
            ->respond($response);
    }
}
