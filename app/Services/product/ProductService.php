<?php

namespace App\Services\Product;

use App\Models\Product;
use App\Models\Specification;

class ProductService implements ProductServiceInterface {
    private Product $product;
    private Specification $specification;

    public function __construct(Product $product, Specification $specification) {
        $this->product = $product;
        $this->specification = $specification;
    }

    /**
     * Get paginated products.
     * 
     * @param string $search - The name of the product to be search.
     * @return mixed - paginated products
     */
    public function getPaginatedProducts($search) {
        return $this->product->search($search)
                                ->withTrashed()
                                ->select('id', 'name', 'price', 'description', 'deleted_at')
                                ->paginate(10);
    }

    /**
     * Store the new product.
     * 
     * @param array $attributes - product attributes
     * @return bool
     */
    public function store(array $attributes) {
        return $this->product->create($attributes);
    }

    /**
     * Find the product by id.
     * 
     * @param int $id - product id
     * @return Product
     */
    public function getById(int $id) {
        return Product::find($id);
    }

    /**
     * Update the product.
     * 
     * @param Product $product - Product which will be update.
     * @param array $attributes - Product attributes
     * @return bool
     */
    public function update(Product $product, array $attributes) {
        return $product->update($attributes);
    }

    /**
     * Soft delete the product.
     * 
     * @param \App\Model\Product $product
     * @return bool
     */
    public function destroy(Product $product): bool {
        return $product->delete();
    }

    /**
     * Restore soft deleted product.
     * 
     * @param \App\Model\Product $product
     * @return bool
     */
    public function restore(Product $product): bool {
        return $product->restore();
    }

    /**
     * Find the product by id and return with specification, file and comment.
     * 
     * @param int $id - product id
     * @return Product
     */
    public function getProductById(int $id) {
        return $this->product->with([
                                    'specifications:name',
                                    'files:id,name,product_id',
                                    'comments:id,comment,user_id,product_id,created_at',
                                    'comments.user:id,firstname,lastname'
                                ])
                                ->find($id, ['id', 'name', 'price', 'description', 'created_at']);
    }

    /**
     * Store the product specification.
     * 
     * @param Product $product
     * @param array $attributes - specification names and values
     * @return bool
     */
    public function storeSpecifications(Product $product, array $attributes) {
        $specification = $this->specification->find($attributes['specification'], ['id']);

        return $product->specifications()->save($specification, [
            'value' => $attributes['specification-value'],
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    /**
     * Update the product specification.
     * 
     * @param Product $product
     * @param int $specificationId
     * @param array $attributes - the specification name and value
     * @return bool
     */
    public function updateSpecification(Product $product, int $specificationId, array $attributes) {
        return $product->specifications()->updateExistingPivot($specificationId, [
            'value' => $attributes['specification-value'],
            'updated_at' => now()
        ]);
    }

    /**
     * Soft delete product specification.
     * 
     * @param \App\Model\Product $product
     * @param int $specificationId
     * @return bool
     */
    public function destroySpecification(Product $product, int $specificationId): bool {
        return $product->specifications()->updateExistingPivot($specificationId, [
            'deleted_at' => now()
        ]);
    }

    /**
     * Restore the soft deleted product specification.
     * 
     * @param Product $product
     * @param int $specificationId
     * @return bool
     */
    public function restoreSpecification(Product $product, int $specificationId) {
        return $product->specifications()->updateExistingPivot($specificationId, [
            'deleted_at' => null
        ]);
    }
}
