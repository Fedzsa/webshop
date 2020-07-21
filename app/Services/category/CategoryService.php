<?php

namespace App\Services\Category;

use App\Exceptions\CategoryNotInsertedException;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Collection;

class CategoryService implements CategoryServiceInterface {
    private Category $category;

    public function __construct(Category $category) {
        $this->category = $category;
    }

    /**
     * Get paginated categories with soft delete categories.
     * 
     * @param string $search The name of the category to be search.
     * @return mixed Paginated list.
     */
    public function getPaginatedCategories($search) {
        return $this->category->search($search)->withTrashed()->paginate(10);
    }

    /**
     * Store new category.
     * 
     * @param array $attributes
     * @return \App\Model\Category
     */
    public function store(array $attributes): Category {
        return $this->category->create($attributes);
    }

    /**
     * Get a category by id.
     * 
     * @param int $id
     * @return Category
     * @throws ModelNotFoundException
     */
    public function getById(int $id): Category {
        $category = $this->category->find($id);

        if(! isset($category))
            throw new ModelNotFoundException('Category not found!');

        return $category;
    }

    /**
     * Update the category.
     * 
     * @param \App\Model\Category $category Category which will be update.
     * @param array $attributes Edited category attributes.
     * @return bool Updated or not.
     */
    public function update(Category $category, array $attributes): bool {
        return $category->update($attributes);
    }

    /**
     * Soft delete category.
     * 
     * @param \App\Model\Category $category
     * @return bool Deleted or not.
     */
    public function destroy(Category $category): bool {
        return $category->delete();
    }

    /**
     * Restore the soft deleted category.
     * 
     * @param \App\Model\Category $category Category which will be restore.
     * @return bool Restored or not.
     */
    public function restore(Category $category): bool {
        return $category->restore();
    }

    /**
     * Search product by name of the product.
     * 
     * @param string $search The name of the product to be search.
     * @return Collection Category list.
     */
    public function search($search): Collection {
        return $this->category->search($search)->get();
    }

    /**
     * Get categories with the specified columns.
     * 
     * @param array $columns Selected column names.
     * @return Collection Category list.
     */
    public function all(...$columns): Collection {
        return $this->category->select('id', 'name')->get();
    }
}
