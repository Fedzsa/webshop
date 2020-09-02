<?php

namespace App\Services\Category;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Category;

interface CategoryServiceInterface
{
    function getPaginatedCategories(string $searchedText);
    function search($search): Collection;
    function getById(int $category): Category;
    function store(array $attributes): Category;
    function update(Category $category, array $attributes): bool;
    function destroy(Category $category): bool;
    function restore(Category $category): bool;
    function all(): Collection;
}
