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

    public function getPaginatedProducts($search) {
        return $this->product->search($search)
                                ->withTrashed()
                                ->select('id', 'name', 'price', 'description', 'deleted_at')
                                ->paginate(10);
    }

    public function store(array $attributes) {
        return $this->product->create($attributes);
    }

    public function getById(int $id) {
        return Product::find($id);
    }

    public function update(Product $product, array $attributes) {
        return $product->update($attributes);
    }

    public function getProductById(int $id) {
        return $this->product->with([
                                    'specifications:name',
                                    'files:id,name,product_id',
                                    'comments:id,comment,user_id,product_id,created_at',
                                    'comments.user:id,firstname,lastname'
                                ])
                                ->find($id, ['id', 'name', 'price', 'description', 'created_at']);
    }

    public function storeSpecifications(Product $product, array $attributes) {
        $specification = $this->specification->find($attributes['specification'], ['id']);

        return $product->specifications()->save($specification, [
            'value' => $attributes['specification-value'],
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    public function updateSpecification(Product $product, int $specificationId, array $attributes) {
        return $product->specifications()->updateExistingPivot($specificationId, [
            'value' => $attributes['specification-value'],
            'updated_at' => now()
        ]);
    }

    public function destroySpecification(Product $product, int $specificationId){
        return $product->specifications()->updateExistingPivot($specificationId, [
            'deleted_at' => now()
        ]);
    }

    public function restoreSpecification(Product $product, int $specificationId) {
        return $product->specifications()->updateExistingPivot($specificationId, [
            'deleted_at' => null
        ]);
    }
}
