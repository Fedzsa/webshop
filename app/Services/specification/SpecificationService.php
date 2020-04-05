<?php


namespace App\Services\Specification;


use App\Models\Specification;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SpecificationService implements SpecificationServiceInterface {
    private Specification $specification;

    public function __construct(Specification $specification) {
        $this->specification = $specification;
    }

    public function getPaginatedSpecifications($search) {
        return $this->specification->search($search)->withTrashed()->paginate(10);
    }

    public function search($search) {
        return $this->specification->search($search)->get();
    }

    public function store(array $attributes) {
        return $this->specification->create($attributes);
    }

    public function getById(int $id, bool $withTrash = false) {
        if(!$withTrash)
            $specification = $this->specification->find($id);
        else
            $specification = $this->specification->withTrashed()->find($id);

        if(!isset($specification))
            throw new ModelNotFoundException('Specification not found!');

        return $specification;
    }

    public function update(Specification $specification, array $attributes): bool {
        return $specification->update($attributes);
    }

    public function destroy(Specification $specification): bool {
        return $specification->delete();
    }

    public function restore(Specification $specification): bool {
        return $specification->restore();
    }
}
