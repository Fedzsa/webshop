<?php

namespace App\Http\Controllers;

use App\Services\Category\CategoryServiceInterface;

class CategoryController extends Controller
{
    private CategoryServiceInterface $categoryService;

    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }
}
