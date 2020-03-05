<?php

namespace App\Services;

use App\Entities\Product;
use App\Filters\ProductFilter;

class ProductService
{
    protected $productFilter;

    public function __construct()
    {
        $this->productFilter = app(ProductFilter::class);
    }

    public function getProducts($limits, $search, $searchKey)
    {
        $query = Product::query();

        if (!empty($searchKey) && !empty($search)) {
            $query = $this->productFilter->search($query, $search, $searchKey);
        }

        $query = $query->with('category')->paginate($limits);

        return $query;
    }
}
