<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpecificationStore;
use App\Models\Specification;
use App\Services\Specification\SpecificationServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SpecificationController extends Controller {
    private SpecificationServiceInterface $specificationService;

    public function __construct(SpecificationServiceInterface $specificationService) {
        $this->specificationService = $specificationService;
    }

    /**
     * Listing the specifications.
     */
    public function index(Request $request) {
        $this->authorize('viewAny', Specification::class);

        $search = $request->query('search');
        $specifications = $this->specificationService->getPaginatedSpecifications($search);

        return view('specification.index', compact(['specifications', 'search']));
    }

    /**
     * Create specification page.
     */
    public function create() {
        $this->authorize('create', Specification::class);

        return view('specification.create');
    }

    /**
     * Store the specification.
     */
    public function store(SpecificationStore $request) {
        $this->authorize('create', Specification::class);

        $inserted = $this->specificationService->store($request->validated());

        if(!$inserted) {
            return back()->withErrors(['status' => 'Specification not inserted!'])->withInput($request->validated());
        }

        return back()->with('status', 'Specification created!');
    }

    /**
     * Edit specification page.
     */
    public function edit(Specification $specification) {
        $this->authorize('update', $specification);

        return view('specification.edit', compact('specification'));
    }

    /**
     * Update the specification.
     */
    public function update(SpecificationStore $request, Specification $specification) {
        $this->authorize('update', $specification);

        $this->specificationService->update($specification, $request->validated());

        return back()->with('status', 'Update successful!')->withInput($request->validated());
    }

    /**
     * Delete specification
     */
    public function destroy(Specification $specification) {
        $this->authorize('delete', $specification);

        $deleted = $this->specificationService->destroy($specification);

        if(! $deleted) {
            return response()->json(['success' => false], 404);
        }

        return response()->json(['success' => true], 200);
    }

    /**
     * Restore the deleted specification.
     */
    public function restore(Specification $specification) {
        $this->authorize('restore', $specification);

        $this->specificationService->restore($specification);

        return response()->json(['success' => true], 200);
    }
}
