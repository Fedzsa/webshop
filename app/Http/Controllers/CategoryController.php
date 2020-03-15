<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategory;
use App\Services\Category\CategoryServiceInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private CategoryServiceInterface $categoryService;

    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;

        $this->middleware('auth');
        $this->middleware('verified');
    }

    public function index(Request $request) {
        $search = $request->filled('search') ? $request->query('search', '') : '';

        $categories = $this->categoryService->getPaginatedCategories($search);

        return view('category.index', ['categories' => $categories, 'searchedText' => $search]);
    }

    public function create() {
        return view('category.create');
    }

    public function store(StoreCategory $request) {
        $this->categoryService->storeCategory($request->validated());

        return back()->with('status', 'Category created!');
    }
}
