<?php

namespace App\Services\Product;

use App\Models\Product;

interface ProductServiceInterface {
    function getPaginatedProducts($search);
    function store(array $attributes);
    function getById(int $id);
    function update(Product $product, array $attributes);
    function getProductById(int $id);
    function storeSpecifications(Product $product, array $attributes);
    function updateSpecification(Product $product, int $specificationId, array $attributes);
    function destroySpecification(Product $product, int $specificationId);
    function restoreSpecification(Product $product, int $specificationId);
}
