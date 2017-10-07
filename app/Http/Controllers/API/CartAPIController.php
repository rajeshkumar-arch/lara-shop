<?php

namespace App\Http\Controllers\API;

use Gloudemans\Shoppingcart\Facades\Cart as Cart;
use App\Services\GuzzleService;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class CartAPIController extends BaseController
{
    protected $guzzleService;

    public function __construct(GuzzleService $guzzleService)
    {
        $this->guzzleService = $guzzleService;
    }

    public function getCartItems()
    {
        $data       = [];
        $cartItems  = [];
        $statusCode = 200;
        $response   = [
            'success' => true,
            'message' => 'Cart List',
        ];
        try {
            foreach (Cart::content() as $cartItem) {
                $item             = [];
                $item['name']     = $cartItem->name;
                $item['slug']     = $cartItem->model->slug;
                $item['image']    = $cartItem->model->image;
                $item['qty']      = $cartItem->qty;
                $item['rowId']    = $cartItem->rowId;
                $item['subtotal'] = $cartItem->subtotal;
                array_push($cartItems, $item);
            }
            $data['items']    = $cartItems;
            $data['subtotal'] = Cart::instance('default')->subtotal();
            $data['tax']      = Cart::instance('default')->tax();
            $data['total']    = Cart::total();
        } catch (\Exception $e) {
            dd($e->getMessage());
            $statusCode = 500;
        }

        return $this
            ->setStatusCode($statusCode)
            ->setDataBag($data)
            ->respond($response);
    }

    public function getProduct($slug)
    {
        $data       = [];
        $statusCode = 200;
        $response   = [
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
