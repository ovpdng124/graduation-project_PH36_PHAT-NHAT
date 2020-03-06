<?php

namespace App\Services;

use App\Entities\Product;
use App\Entities\ProductImage;
use App\Filters\ProductFilter;
use Illuminate\Database\Eloquent\Builder;

class ProductService
{
    /**
     * @var ProductFilter
     */
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

        $query = $query->with('category', 'product_images')->paginate($limits);

        return $query;
    }

    public function store($params, $avatar)
    {
        $product = Product::create($params);

        return $this->saveAvatar($avatar, $product->id);
    }

    public function saveAvatar($avatar, $id)
    {
        $avatarName = $avatar->getClientOriginalName();

        $avatar->move('images/avatar', $avatarName);

        $productAvatar = [
            'product_id' => $id,
            'image_path' => ("/images/avatar/$avatarName"),
            'image_type' => ProductImage::$types['Avatar'],
        ];

        return ProductImage::create($productAvatar);
    }
}
