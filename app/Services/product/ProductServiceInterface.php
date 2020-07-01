<?php

namespace App\Services\Product;

use App\Models\Product;

interface ProductServiceInterface {
    function getPaginatedProducts($search);
    function store(array $attributes);
    function getById(int $id);
    function update(Product $product, array $attributes);
    function destroy(Product $product): bool;
    function restore(Product $product): bool;
    function getProductById(int $id);
    function storeSpecifications(Product $product, array $attributes);
    function updateSpecification(Product $product, int $specificationId, array $attributes);
    function destroySpecification(Product $product, int $specificationId): bool;
    function restoreSpecification(Product $product, int $specificationId);
}
