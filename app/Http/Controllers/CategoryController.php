<?php

namespace App\Http\Controllers;

use App\Services\Category\CategoryServiceInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private CategoryServiceInterface $categoryService;

    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request) {
        $search = $request->filled('search') ? $request->query('search', '') : '';

        $categories = $this->categoryService->getPaginatedCategories($search);

        return view('category.index', ['categories' => $categories, 'searchedText' => $search]);
    }
}
