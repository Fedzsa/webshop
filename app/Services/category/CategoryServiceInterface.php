<?php

namespace App\Services\Category;

interface CategoryServiceInterface
{
    function getPaginatedCategories(string $searchedText);
}
