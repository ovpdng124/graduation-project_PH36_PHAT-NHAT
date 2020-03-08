<?php

namespace App\Services;

use App\Entities\Category;
use App\Filters\CategoryFilter;

class CategoryService
{
    /**
     * @var CategoryFilter
     */
    protected $categoryFilter;

    public function __construct()
    {
        $this->categoryFilter = app(CategoryFilter::class);
    }

    public function getCategories($limits, $search, $searchKey)
    {
        $query = Category::query();

        if (!empty($search) && !empty($searchKey)) {
            $query = $this->categoryFilter->search($query, $search, $searchKey);
        }

        $query = $query->with('products')->paginate($limits);

        return $query;
    }
}
