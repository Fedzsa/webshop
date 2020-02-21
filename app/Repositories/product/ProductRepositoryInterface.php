<?php

namespace App\Repositories\Product;

use App\Models\Product;

interface ProductRepositoryInterface {
    function getProducts();
    function storeProduct(Product $product);
}