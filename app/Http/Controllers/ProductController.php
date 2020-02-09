<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Product\ProductServiceInterface;

class ProductController extends Controller
{
    private ProductServiceInterface $productService;

    public function __construct(ProductServiceInterface $productService) {
        $this->productService = $productService;
    }

    public function index() {
        $products = $this->productService->getProducts();

        return view('product.index', ['products' => $products]);
    }

    public function show($id) {
        // todo
        dd(\App\Models\Product::find($id));
    }
}
