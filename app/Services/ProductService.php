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

        return $this->storeAvatar($avatar, $product->id);
    }

    public function storeAvatar($avatar, $id)
    {
        $avatarName = $avatar->getClientOriginalName();
        $path       = ProductImage::$paths['Avatar'];
        $type       = ProductImage::$types['Avatar'];

        $avatar->move($path, $avatarName);

        $productAvatar = [
            'product_id' => $id,
            'image_path' => $path . $avatarName,
            'image_type' => $type,
        ];

        return ProductImage::create($productAvatar);
    }

    public function updateAvatar($avatar, $id)
    {
        $avatarName         = $avatar->getClientOriginalName();
        $path               = ProductImage::$paths['Avatar'];
        $data['image_path'] = $path . $avatarName;

        $avatar->move($path, $avatarName);

        $product_image = ProductImage::where('product_id', $id)->first();

        return $product_image->update($data);
    }
}
