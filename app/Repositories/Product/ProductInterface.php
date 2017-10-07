<?php

namespace App\Repositories\Product;

interface ProductInterface
{
    public function getAll();

    public function find($id);

    public function delete($id);

    public function findSlug($slug);
}
