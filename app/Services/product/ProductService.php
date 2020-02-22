<?php

namespace App\Services\Product;

use App\Services\Product\ProductServiceInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Models\Product;

class ProductService implements ProductServiceInterface {
    private ProductRepositoryInterface $productRepo;

    public function __construct(ProductRepositoryInterface $productRepo) {
        $this->productRepo = $productRepo;
    }

    public function getpaginatedProducts() {
        return $this->productRepo->getPaginatedProducts();
    }

    public function storeProduct(array $attributes) {
        $product = new Product($attributes);

        return $this->productRepo->storeProduct($product);
    }
}