<?php

namespace App\Services\Product;

interface ProductServiceInterface {
    function getPaginatedProducts(string $search);
    function storeProduct(array $attributes);
    function getProductById(int $id);
    function updateProduct(int $id, array $attributes);
    function getProductByIdWithSpecifications(int $id);
}