<?php

namespace App\Services\Category;

use App\Exceptions\CategoryNotInsertedException;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryService implements CategoryServiceInterface {
    private Category $category;

    public function __construct(Category $category) {
        $this->category = $category;
    }

    public function getPaginatedCategories($search) {
        return $this->category->search($search)->withTrashed()->paginate(10);
    }

    public function store(array $attributes) {
        return $this->category->create($attributes);
    }

    public function getById(int $id) {
        $category = $this->category->find($id);

        if(! isset($category))
            throw new ModelNotFoundException('Category not found!');

        return $category;
    }

    public function update(Category $category, array $attributes): bool {
        return $category->update($attributes);
    }

    /**
     * Soft delete category.
     * 
     * @param \App\Model\Category $category
     * @return bool
     */
    public function destroy(Category $category): bool {
        return $category->delete();
    }

    public function restore(Category $category): bool {
        return $category->restore();
    }

    public function search($search) {
        return $this->category->search($search)->get();
    }

    public function all(...$columns) {
        return $this->category->select('id', 'name')->get();
    }
}
