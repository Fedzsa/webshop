<?php

namespace App\Services\Category;

use App\Models\Category;

interface CategoryServiceInterface {
    function getPaginatedCategories(string $searchedText);
    function search($search);
    function getById(int $category);
    function store(array $attributes);
    function update(Category $category, array $attributes): bool;
    function destroy(Category $category): bool;
    function restore(Category $category): bool;
}
