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

    public function edit($id) {
        $category = $this->categoryService->getCategory((int)$id);

        return view('category.edit', ['category' => $category]);
    }

    public function update(StoreCategory $request, $id) {
        $updated = $this->categoryService->updateCategory((int)$id, $request->validated());

        if($updated)
            return back()->with('status', 'Category updated!')->withInput($request->all());
        else
            return back()->with('status', 'Category not updated!')->withInput($request->all());
    }

    public function delete($id) {
        $category = $this->categoryService->getCategory((int)$id);

        return view('category.delete', ['category' => $category]);
    }

    public function destroy($id) {
        $deleted = $this->categoryService->destroyCategory((int) $id);

        if($deleted)
            return redirect()->route('categories.index');
        else
            return back()->withErrors(['status', 'Category not be deleted!'])->withInput();
    }
}
