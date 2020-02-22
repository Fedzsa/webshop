<?php

namespace App\Services\Product;

interface ProductServiceInterface {
    function getPaginatedProducts();
    function storeProduct(array $attributes);
    function getProductByIdForUpdate(int $id);
    function updateProduct(int $id, array $attributes);
}