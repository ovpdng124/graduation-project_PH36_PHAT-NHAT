<?php

namespace App\Filters;

class CategoryFilter
{
    public function searchByName($query, $search)
    {
        return $query->where('name', 'like', "%$search%");
    }
}
