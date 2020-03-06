<?php

namespace App\Filters;


use Illuminate\Database\Eloquent\Builder;

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

    public function searchByCategory($query, $search)
    {
        return $query->whereHas('category', function (Builder $query) use ($search) {
            $query->where('name', 'like', "%$search%");
        });
    }
}
