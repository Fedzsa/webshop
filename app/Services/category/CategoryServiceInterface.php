<?php

namespace App\Services\Category;

interface CategoryServiceInterface
{
    function getPaginatedCategories(string $searchedText);
    function storeCategory(array $attributes);
    function getCategory(int $id);
    function updateCategory(int $id, array $attributes);
    function destroyCategory(int $id);
}
