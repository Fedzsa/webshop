<?php

namespace App\Services\Category;

use App\Exceptions\CategoryNotInsertedException;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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

    public function getCategory(int $id)
    {
        return $this->category->findOrFail($id);
    }

    public function updateCategory(int $id, array $attributes) {
        $category = $this->category->findOrFail($id);

        $category->fill($attributes);

        return $category->save();
    }

    public function destroyCategory(int $id) {
        $category = $this->category->findOrFail($id);

        return $category->delete();
    }
}
