<?php

namespace App\Repositories\Product;

use App\Models\Product;

interface ProductRepositoryInterface {
    function getPaginatedProducts(string $search);
    function storeProduct(Product $product);
    function getProductById(int $id);
    function updateProduct(Product $product);
}