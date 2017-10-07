<?php

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'Playstation 4',
            'slug' => 'playstation-4',
            'description' => 'description goes here',
            'price' => 399.99,
            'image' => url('/images/product.png'),
            'user_id' => 1,
        ]);

        Product::create([
            'name' => 'Xbox One',
            'slug' => 'xbox-one',
            'description' => 'description goes here',
            'price' => 449.99,
            'image' => url('/images/product.png'),
            'user_id' => 1,
        ]);

        Product::create([
            'name' => 'Apple Macbook Pro',
            'slug' => 'macbook-pro',
            'description' => 'description goes here',
            'price' => 2299.99,
            'image' => url('/images/product.png'),
            'user_id' => 1,
        ]);

        Product::create([
            'name' => 'Apple iPad Retina',
            'slug' => 'ipad-retina',
            'description' => 'description goes here',
            'price' => 799.99,
            'image' => url('/images/product.png'),
            'user_id' => 1,
        ]);

        Product::create([
            'name' => 'Acoustic Guitar',
            'slug' => 'acoustic-guitar',
            'description' => 'description goes here',
            'price' => 699.99,
            'image' => url('/images/product.png'),
            'user_id' => 1,
        ]);

        Product::create([
            'name' => 'Electric Guitar',
            'slug' => 'electric-guitar',
            'description' => 'description goes here',
            'price' => 899.99,
            'image' => url('/images/product.png'),
            'user_id' => 1,
        ]);

        Product::create([
            'name' => 'Headphones',
            'slug' => 'headphones',
            'description' => 'description goes here',
            'price' => 99.99,
            'image' => url('/images/product.png'),
            'user_id' => 1,
        ]);

        Product::create([
            'name' => 'Speakers',
            'slug' => 'speakers',
            'description' => 'description goes here',
            'price' => 499.99,
            'image' => url('/images/product.png'),
            'user_id' => 1,
        ]);
    }
}
