<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategory;
use App\Models\Category;
use App\Services\Category\CategoryServiceInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller {
    private CategoryServiceInterface $categoryService;

    public function __construct(CategoryServiceInterface $categoryService) {
        $this->categoryService = $categoryService;

        $this->middleware('auth');
        $this->middleware('verified');
    }

    /**
     * Listing categories.
     */
    public function index(Request $request) {
        $this->authorize('viewAny', Category::class);

        $search = $request->query('search');

        $categories = $this->categoryService->getPaginatedCategories($search);

        return view('category.index', compact(['categories', 'search']));
    }

    /**
     * Create category page.
     */
    public function create() {
        $this->authorize('create', Category::class);

        return view('category.create');
    }

    /**
     * Create category.
     */
    public function store(StoreCategory $request) {
        $this->authorize('create', Category::class);

        $this->categoryService->store($request->validated());

        return back()->with('status', 'Category created!');
    }

    /**
     * Edit category page.
     */
    public function edit(Category $category) {
        $this->authorize('update', $category);

        return view('category.edit', compact('category'));
    }

    /**
     * Update category.
     */
    public function update(StoreCategory $request, Category $category) {
        $this->authorize('update', $category);

        $this->categoryService->update($category, $request->validated());

        return back()->with('status', 'Category updated!')->withInput($request->all());
    }

    /**
     * Delete category
     */
    public function destroy(Category $category) {
        $this->authorize('delete', $category);

        $deleted = $this->categoryService->destroy($category);

        if(! $deleted) {
            return response()->json(['success' => false], 404);
        }

        return response()->json(['success' => true], 200);
    }

    /**
     * Restore deleted category.
     */
    public function restore(Category $category) {
        $this->authorize('restore', $category);

        $this->categoryService->restore($category);

        return response()->json(['success' => true]);
    }
}
