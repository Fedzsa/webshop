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

        $this->middleware('auth');
        $this->middleware('verified');
    }

    public function index(Request $request) {
        $this->authorize('viewAny', Product::class);

        $search = $request->query('search');

        $products = $this->productService->getPaginatedProducts($search);

        return view('product.index', compact(['products', 'search']));
    }

    public function show(int $product) {
        $product = $this->productService->getProductByIdWithSpecificationsAndImages($product);
        
        return view('product.show', compact('product'));
    }

    public function create() {
        $this->authorize('create', Product::class);

        $categories = $this->categoryService->all();

        return view('product.create', compact('categories'));
    }

    public function store(StoreProduct $request) {
        $this->authorize('create', Product::class);

        $isInserted = $this->productService->store($request->validated());

        if(! $isInserted) {
            return back()->withErrors(['status' => 'Product not created!'])->withInput($request->validated());
        }

        return back()->with('status', 'Product created!')->withInput($request->validated());
    }

    public function edit(Product $product) {
        $this->authorize('update', $product);

        $categories = $this->categoryService->all();

        return view('product.edit', compact(['product', 'categories']));
    }

    public function update(StoreProduct $request, Product $product) {
        $this->authorize('update', $product);

        $isUpdated = $this->productService->update($product, $request->validated());

        if(! $isUpdated) {
            return back()->withErrors(['status' => 'Product not updated!'])->withInput($request->validated());
        }

        return back()->with('status', 'Product updated!')->withInput($request->validated());
    }

    public function images(Product $product) {
        $this->authorize('upload', $product);

        $images = $product->files()->get(['id', 'name']);

        return view('product.images', compact(['product', 'images']));
    }

    public function storeImage(StoreImage $request, Product $product) {
        $this->authorize('create', $product);

        if(! $request->hasFile('image')) {
            return back()->withErrors(['status' => 'No uploaded file!']);
        }

        $this->fileService->store($product, $request->file('image'));

        return back()->with('status', 'Image uploaded!');
    }

    public function destroyImage(Product $product, File $file) {
        $this->authorize('delete', $product);

        $this->fileService->destroy($file);

        return response()->json(['success' => true]);
    }
}