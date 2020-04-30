<?php


namespace App\Services\Specification;


use App\Models\Specification;

interface SpecificationServiceInterface {
    function getPaginatedSpecifications($search);
    function store(array $attributes);
    function getById(int $id, bool $withTrash = false);
    function search($search);
    function update(Specification $specification, array $attributes): bool;
    function destroy(Specification $specification): bool;
    function restore(Specification $specification): bool;
    function all(...$columns);
}
