<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Specification;
use App\Http\Requests\StoreProductSpecification;
use App\Http\Requests\UpdateProductSpecification;
use App\Services\Product\ProductServiceInterface;
use App\Services\Specification\SpecificationServiceInterface;

class ProductSpecificationController extends Controller {
    private ProductServiceInterface $productService;
    private SpecificationServiceInterface $specificationService;

    public function __construct(ProductServiceInterface $productService, SpecificationServiceInterface $specificationService) {
        $this->productService = $productService;
        $this->specificationService = $specificationService;

        $this->middleware('auth');
        $this->middleware('verified');
    }

    public function index(Product $product) {
        $this->authorize('viewAny', Product::class);

        $specifications = $product->specifications()->get(['id', 'name']);

        return view('product.specification.index', compact(['product', 'specifications']));
    }

    public function create(Product $product) {
        $this->authorize('create', Product::class);

        $specifications = $this->specificationService->all('id', 'name');

        return view('product.specification.create', compact(['product', 'specifications']));
    }

    public function store(StoreProductSpecification $request, Product $product) {
        $this->productService->storeSpecifications($product, $request->validated());

        return back()->with('status', 'Specification added!')->withInput($request->validated());
    }

    public function edit(Product $product, int $specification) {
        $this->authorize('update', $product);

        $specifications = $this->specificationService->all('id', 'name');
        $specification = $product->specifications()->find($specification, ['id', 'name']);

        return view('product.specification.edit', compact(['product', 'specifications', 'specification']));
    }

    public function update(UpdateProductSpecification $request, Product $product, int $specification) {
        $updated = $this->productService->updateSpecification($product, $specification, $request->validated());
        
        if(! $updated) {
            return back()->withErrors('status', $product->name.' specification value not updated!')->withInput($request->validated());
        }
        
        return back()->with('status', $product->name.' specification value updated!')->withInput($request->validated());
    }

    public function delete(Product $product, Specification $specification) {
        return view('product.specification.delete', compact(['product', 'specification']));
    }

    public function destroy(Product $product, int $specification) {
        $deleted = $this->productService->destroySpecification($product, $specification);

        if(! $deleted) {
            return back()->withErrors(['status' => 'Specification not deleted!'])->withInput();
        }

        return redirect()->route('products.specifications.index', ['product' => $product->id]);
    }

    public function restore(Product $product, int $specification) {
        $this->productService->restoreSpecification($product, $specification);

        return response()->json(['success' => true]);
    }
}