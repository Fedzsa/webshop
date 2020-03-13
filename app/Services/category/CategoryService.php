<?php

namespace App\Services\Category;

use App\Models\Category;

class CategoryService implements CategoryServiceInterface
{
    private Category $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getPaginatedCategories()
    {
        return $this->category->paginate(10);
    }
}
