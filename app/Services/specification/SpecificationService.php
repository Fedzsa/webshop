<?php


namespace App\Services\Specification;


use App\Models\Specification;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SpecificationService implements SpecificationServiceInterface {
    private Specification $specification;

    public function __construct(Specification $specification) {
        $this->specification = $specification;
    }

    /**
     * Get the paginated specifications.
     * 
     * @param string $search
     * @return mixed
     */
    public function getPaginatedSpecifications($search) {
        return $this->specification->search($search)->withTrashed()->paginate(10);
    }

    /**
     * Search the specification by name.
     * 
     * @param string $search
     * @return Specification
     */
    public function search($search) {
        return $this->specification->search($search)->get();
    }

    /**
     * Store the new specification.
     * 
     * @param array $attributes - specification attributes
     * @return bool
     */
    public function store(array $attributes) {
        return $this->specification->create($attributes);
    }

    /**
     * Find the specification by id.
     * 
     * @param int $id - specification id
     * @param bool $withTrash - get the deleted specification, too
     * @return Specification
     * @throws ModelNotFoundException
     */
    public function getById(int $id, bool $withTrash = false) {
        if(!$withTrash)
            $specification = $this->specification->find($id);
        else
            $specification = $this->specification->withTrashed()->find($id);

        if(!isset($specification))
            throw new ModelNotFoundException('Specification not found!');

        return $specification;
    }

    /**
     * Update the specification.
     * 
     * @param Specification $specification
     * @param array $attributes - specification attributes
     * @return bool
     */
    public function update(Specification $specification, array $attributes): bool {
        return $specification->update($attributes);
    }

    /**
     * Soft delete specification.
     * 
     * @param \App\Model\Specification $specification
     * @return bool
     */
    public function destroy(Specification $specification): bool {
        return $specification->delete();
    }

    /**
     * Restore the deleted specification.
     * 
     * @param Specification $specification
     * @return bool
     */
    public function restore(Specification $specification): bool {
        return $specification->restore();
    }

    /**
     * Get all specification with given columns.
     * 
     * @param array $columns - column names
     * @return Specification[]
     */
    function all(...$columns) {
        return $this->specification
                    ->when($columns, function($query, $columns) {
                        return $query->select($columns);
                    })
                    ->get();
    }
}
