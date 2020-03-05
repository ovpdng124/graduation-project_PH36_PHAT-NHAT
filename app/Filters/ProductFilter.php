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

    public function searchByCategory($query, $search)
    {
        return $query->select('products.*')->join('categories', 'products.category_id', '=', 'categories.id')->where('categories.name', 'like', "%$search%");
    }
}
