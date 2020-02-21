<?php

namespace App\Services\Product;

interface ProductServiceInterface {
    function getProducts();
    function storeProduct(array $attributes);
}