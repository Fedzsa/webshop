<?php

namespace App\Services\Product;

use App\Services\Product\ProductServiceInterface;
use App\Repositories\Product\ProductRepositoryInterface;

class ProductService implements ProductServiceInterface {
    private ProductRepositoryInterface $productRepo;

    public function __construct(ProductRepositoryInterface $productRepo) {
        $this->productRepo = $productRepo;
    }

    public function getProducts() {
        return $this->productRepo->getProducts();
    }
}