<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Profile;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Validator;

class ProductsManagementController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return View('productsmanagement.show-products')->with(['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('productsmanagement.create-product');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:255|unique:products',
                'slug' => 'required|max:255|unique:products',
                'description' => 'required|max:600',
                'image' => 'required|max:255',
                'price' => 'required|numeric',
            ],
            [
                'name.unique' => 'Product name is already taken',
                'name.required' => 'Product name is required',
                'slug.required' => 'Product slug is required',
                'slug.unique' => 'Product slug is already taken',
                'description.required' => 'Product Description is required',
                'image.required' => 'image URL is required',
                'price.required' => 'Product price required',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $currentUser = Auth::user();
        $product     = product::create([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'description' => $request->input('description'),
            'image' => $request->input('image'),
            'price' => $request->input('price'),
            'user_id' => $currentUser->id,
        ]);

        return redirect('products')->with('success', trans('productsmanagement.createSuccess'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        return view('productsmanagement.show-product')->withProduct($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('productsmanagement.edit-product')->withProduct($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $currentUser = Auth::user();
        $product     = Product::find($id);

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:255',
                'slug' => 'required|max:255',
                'description' => 'required|max:600',
                'image' => 'required|max:255',
                'price' => 'required|max:10',
            ],
            [
                'name.unique' => 'Product name is already taken',
                'name.required' => 'Product name is required',
                'slug.required' => 'Product slug is required',
                'slug.unique' => 'Product slug is already taken',
                'description.required' => 'Product Description is required',
                'image.required' => 'image URL is required',
                'price.required' => 'Product price required',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $product->name        = $request->input('name');
        $product->slug        = $request->input('slug');
        $product->description = $request->input('description');
        $product->price       = $request->input('price');
        $product->image       = $request->input('image');
        $product->save();

        return back()->with('success', trans('productsmanagement.updateSuccess'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product) {
            $product->delete();

            return redirect('products')->with('success', trans('productsmanagement.deleteSuccess'));
        }

        return back()->with('error', 'Failed to delete product');
    }
}
