<?php

namespace App\Filters;

class CategoryFilter extends FilterBase
{
    public function searchByName($query, $search)
    {
        return $query->where('name', 'like', "%$search%");
    }
}
