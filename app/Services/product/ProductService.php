<?php

namespace App\Services\Product;

use App\Models\Product;

class ProductService implements ProductServiceInterface {

    public function __construct() {

    }

    public function getPaginatedProducts(string $search) {
        return Product::where('name','like', '%'.$search.'%')->paginate(10);
    }

    public function storeProduct(array $attributes) {
        $product = new Product($attributes);

        return $product->save();
    }

    public function getProductById(int $id) {
        return Product::find($id);
    }

    public function updateProduct(int $id, array $attributes) {
        $product = $this->getProductById($id);

        $product->fill($attributes);

        return $product->save();
    }

    public function getProductByIdWithSpecifications(int $id) {
        return Product::with('specifications')->find($id);
    }
}
