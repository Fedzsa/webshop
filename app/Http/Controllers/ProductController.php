<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreImage;
use App\Http\Requests\StoreProduct;
use App\Services\File\FileServiceInterface;
use App\Services\Product\ProductServiceInterface;
use App\Services\Category\CategoryServiceInterface;
use App\Services\Specification\SpecificationServiceInterface;

class ProductController extends Controller {
    private ProductServiceInterface $productService;
    private CategoryServiceInterface $categoryService;
    private SpecificationServiceInterface $specificationService;
    private FileServiceInterface $fileService;

    public function __construct(ProductServiceInterface $productService,
                                CategoryServiceInterface $categoryService,
                                SpecificationServiceInterface $specificationService,
                                FileServiceInterface $fileService) {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->specificationService = $specificationService;
        $this->fileService = $fileService;
    }

    /**
     * Listing the products.
     */
    public function index(Request $request) {
        $this->authorize('viewAny', Product::class);

        $search = $request->query('search');

        $products = $this->productService->getPaginatedProducts($search);

        return view('product.index', compact(['products', 'search']));
    }

    /**
     * Show the product page.
     */
    public function show(int $product) {
        $product = $this->productService->getProductById($product);

        return view('product.show', compact('product'));
    }

    /**
     * Create product page.
     */
    public function create() {
        $this->authorize('create', Product::class);

        $categories = $this->categoryService->all();

        return view('product.create', compact('categories'));
    }

    /**
     * Store product.
     */
    public function store(StoreProduct $request) {
        $this->authorize('create', Product::class);

        $isInserted = $this->productService->store($request->validated());

        if(! $isInserted) {
            return back()->withErrors(['status' => 'Product not created!'])->withInput($request->validated());
        }

        return back()->with('status', 'Product created!')->withInput($request->validated());
    }

    /**
     * Edit product page.
     */
    public function edit(Product $product) {
        $this->authorize('update', $product);

        $categories = $this->categoryService->all();

        return view('product.edit', compact(['product', 'categories']));
    }

    /**
     * Update product.
     */
    public function update(StoreProduct $request, Product $product) {
        $this->authorize('update', $product);

        $isUpdated = $this->productService->update($product, $request->validated());

        if(! $isUpdated) {
            return back()->withErrors(['status' => 'Product not updated!'])->withInput($request->validated());
        }

        return back()->with('status', 'Product updated!')->withInput($request->validated());
    }

    /**
     * Delete the product
     */
    public function destroy(Product $product) {
        $this->authorize('delete', $product);

        $this->productService->destroy($product);

        return response()->json(['success' => true], 200);
    }

    /**
     * Restore soft deleted product.
     */
    public function restore(Product $product) {
        $this->authorize('restore', $product);

        $this->productService->restore($product);

        return response()->json(['success' => true], 200);
    }

    /**
     * Display images of the product.
     */
    public function images(Product $product) {
        $this->authorize('upload', $product);

        $images = $product->files()->get(['id', 'name']);

        return view('product.images', compact(['product', 'images']));
    }

    /**
     * Store image.
     */
    public function storeImage(StoreImage $request, Product $product) {
        $this->authorize('create', $product);

        if(! $request->hasFile('image')) {
            return back()->withErrors(['status' => 'No uploaded file!']);
        }

        $this->fileService->store($product, $request->file('image'));

        return back()->with('status', 'Image uploaded!');
    }

    /**
     * Delete image.
     */
    public function destroyImage(Product $product, File $file) {
        $this->authorize('delete', $product);

        $this->fileService->destroy($file);

        return response()->json(['success' => true]);
    }
}
