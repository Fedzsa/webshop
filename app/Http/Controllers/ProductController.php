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

    public function index() {
        $products = $this->productService->getPaginatedProducts();

        return view('product.index', ['products' => $products]);
    }

    public function create() {
        return view('product.create');
    }

    public function store(StoreProduct $request) {
        $isInserted = $this->productService->storeProduct($request->validated());

        if($isInserted)
            return redirect()->route('products');
        else
            return redirect()->withInput();
    }

    public function edit($id) {
        // todo
        dd(\App\Models\Product::find($id));
    }

}
