<?php

namespace App\Filters;

class ProductFilter extends FilterBase
{
    public function searchByName($query, $search)
    {
        return $query->where("name", "like", "%$search%");
    }

    public function searchByPrice($query, $search)
    {
        return $query->where("price", "like", "%$search%");
    }

    public function searchByDescription($query, $search)
    {
        return $query->where("description", "like", "%$search%");
    }

    public function searchByCategory($query, $search)
    {
        return $query->whereHas('category', function ($query) use ($search) {
            $query->where('name', 'like', "%$search%");
        });
    }

    public function searchBySize($query, $search)
    {
        return $query->where("size", "like", "%$search%");
    }

    public function searchByColor($query, $search)
    {
        return $query->where("color", "like", "%$search%");
    }
}
