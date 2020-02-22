<?php

namespace App\Repositories\Product;

use App\Repositories\Product\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface {

    public function getPaginatedProducts() {
        return Product::paginate(10);
    }

    public function storeProduct(Product $product) {
        return $product->save();
    }

    public function getProductById(int $id) {
        return Product::find($id);
    }

    public function updateProduct(Product $product) {
        return $product->save();
    }
}