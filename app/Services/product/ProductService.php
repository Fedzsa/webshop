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

    public function getProductByIdForUpdate(int $id) {
        return $this->productRepo->getProductById($id);
    }

    function updateProduct(int $id, array $attributes) {
        $product = $this->getProductByIdForUpdate($id);

        $product->fill($attributes);

        return $this->productRepo->updateProduct($product);
    }
}