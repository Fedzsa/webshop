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

    public function index(Request $request) {
        $this->authorize('viewAny', Category::class);

        $search = $request->query('search');

        $categories = $this->categoryService->getPaginatedCategories($search);

        return view('category.index', compact(['categories', 'search']));
    }

    public function create() {
        $this->authorize('create', Category::class);

        return view('category.create');
    }

    public function store(StoreCategory $request) {
        $this->authorize('create', Category::class);

        $this->categoryService->store($request->validated());

        return back()->with('status', 'Category created!');
    }

    public function edit(Category $category) {
        $this->authorize('update', $category);

        return view('category.edit', compact('category'));
    }

    public function update(StoreCategory $request, Category $category) {
        $this->authorize('update', $category);

        $this->categoryService->update($category, $request->validated());

        return back()->with('status', 'Category updated!')->withInput($request->all());
    }

    public function delete(Category $category) {
        $this->authorize('delete', $category);

        return view('category.delete', compact('category'));
    }

    public function destroy(Category $category) {
        $this->authorize('delete', $category);

        $this->categoryService->destroy($category);

        return redirect()->route('categories.index');
    }

    public function restore(Category $category) {
        $this->authorize('restore', $category);

        $this->categoryService->restore($category);

        return response()->json(['success' => true]);
    }
}
