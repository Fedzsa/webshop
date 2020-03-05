<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Product\ProductServiceInterface;
use App\Http\Requests\StoreProduct;

class ProductController extends Controller
{
    private ProductServiceInterface $productService;

    public function __construct(ProductServiceInterface $productService) {
        $this->productService = $productService;

        $this->middleware('auth');
    }

    public function index(Request $request) {
        $search = $request->filled('search') ? $request->query('search', '') : '';

        $products = $this->productService->getPaginatedProducts($search);
        
        return view('product.index', ['products' => $products, 'searchedText' => $search]);
    }

    public function create() {
        return view('product.create');
    }

    public function store(StoreProduct $request) {
        $isInserted = $this->productService->storeProduct($request->validated());

        if($isInserted)
            return redirect()->route('products');
        else
            return back()->withInput();
    }

    public function edit($id) {
        $product = $this->productService->getProductByIdForUpdate((int)$id);

        $this->authorize('view', $product);

        return view('product.update', ['product' => $product]);
    }

    public function update(StoreProduct $request, $id) {
        $product = $this->productService->getProductByIdForUpdate((int)$id);

        $this->authorize('update', $product);

        $isUpdated = $this->productService->updateProduct((int)$id, $request->validated());

        if($isUpdated)
            return redirect()->route('products');
        else
            return back()->withInput();
    }
}
