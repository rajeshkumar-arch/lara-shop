<?php

namespace App\Repositories\Product;

use App\Models\Product;

class ProductRepository implements ProductInterface
{
    public function getAll()
    {
        return Product::all();
    }

    public function find($id)
    {
        return Product::find($id);
    }

    public function delete($id)
    {
        return Product::delete($id);
    }

    public function findSlug($slug)
    {
        return Product::where('slug', $slug)->firstOrFail();
    }
}
