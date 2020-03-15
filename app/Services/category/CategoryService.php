<?php

namespace App\Services\Category;

use App\Exceptions\CategoryNotInsertedException;
use App\Models\Category;

class CategoryService implements CategoryServiceInterface
{
    private Category $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getPaginatedCategories(string $searchedText)
    {
        return $this->category->where('name', 'like', '%'.$searchedText.'%')->paginate(10);
    }

    public function storeCategory(array $attributes)
    {
        $saved = $this->category->create($attributes);

        if(!$saved)
            throw new CategoryNotInsertedException('Category not inserted!');
    }
}
