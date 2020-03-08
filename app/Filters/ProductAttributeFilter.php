<?php


namespace App\Filters;


class ProductAttributeFilter
{
    public function searchByName($query, $search)
    {
        return $query->where("name", "like", "%$search%");
    }

    public function searchByPrice($query, $search)
    {
        return $query->where("price", "like", "%$search%");
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
