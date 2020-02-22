<?php

namespace App\Services\Product;

interface ProductServiceInterface {
    function getPaginatedProducts();
    function storeProduct(array $attributes);
}