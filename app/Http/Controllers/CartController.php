<?php

namespace App\Http\Controllers;

use App\Services\GuzzleService;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart as Cart;
use Illuminate\Support\Facades\Session;
use Validator;

class CartController extends Controller
{
    protected $guzzleService;

    public function __construct(GuzzleService $guzzleService)
    {
        $this->guzzleService = $guzzleService;
        $this->guzzleService->setHost(url('/'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartItems  = [];
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
        return view('shop.show-cart')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $duplicates = Cart::search(function ($cartItem, $rowId) use ($request) {
            return $cartItem->id === $request->id;
        });

        if (!$duplicates->isEmpty()) {
            return redirect('cart')->withSuccessMessage('Item is already in your cart!');
        }

        Cart::add($request->id, $request->name, 1, $request->price)->associate('App\Models\Product');

        return redirect('cart')->withSuccessMessage('Item was added to your cart!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        // Validation on max quantity
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric|between:1,5',
        ]);

        if ($validator->fails()) {
            session()->flash('error_message', 'Quantity must be between 1 and 5.');

            return response()->json(['success' => false]);
        }

        Cart::update($id, $request->quantity);
        session()->flash('success_message', 'Quantity was updated successfully!');

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);

        return redirect('cart')->withSuccessMessage('Item has been removed!');
    }

    /**
     * Remove the resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function emptyCart()
    {
        Cart::destroy();

        return redirect('cart')->withSuccessMessage('Your cart has been cleared!');
    }
}
