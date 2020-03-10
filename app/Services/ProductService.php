<?php

namespace App\Services;

use App\Entities\Product;
use App\Entities\ProductImage;
use App\Filters\ProductFilter;
use App\Helpers\GlobalHelper;

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

    public function store($request)
    {
        $params = $request->except('_token', 'avatar');

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');

            $product = Product::create($params);

            return $this->storeAvatar($avatar, $product->id);
        }

        return false;
    }

    public function storeAvatar($avatar, $id)
    {
        $avatarName = $avatar->getClientOriginalName();
        $path       = ProductImage::$paths['Avatar'] . $id . '/';
        $type       = ProductImage::$types['Avatar'];

        $avatar->move(public_path($path), $avatarName);

        $productAvatar = [
            'product_id' => $id,
            'image_path' => $path . $avatarName,
            'image_type' => $type,
        ];

        return ProductImage::create($productAvatar);
    }

    public function update($request, $id)
    {
        $params = $request->except('_token', 'avatar');

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');

            $this->updateAvatar($avatar, $id);
        }

        return Product::find($id)->update($params);
    }

    public function updateAvatar($avatar, $id)
    {
        $avatarName         = $avatar->getClientOriginalName();
        $path               = ProductImage::$paths['Avatar'] . $id . '/';
        $data['image_path'] = $path . $avatarName;

        $avatar->move(public_path($path), $avatarName);

        $product_image = ProductImage::where('product_id', $id)->first();

        return $product_image->update($data);
    }

    public function getNewArrivals($products)
    {
        $chunk = $products->splice(0, 9);

        foreach ($products as $product) {
            $product->is_new = true;

            if (GlobalHelper::checkExpiredDate($product->created_at, 7)) {
                $product->is_new = false;
            }
        }

        return $products->merge($chunk);
    }

    public function getPopularProducts($products)
    {
        $popularProducts = [];

        foreach ($products as $item) {
            foreach ($item->product_images as $image) {
                $popularProducts[] = [
                    'product_id' => $item->id,
                    'image_path' => $image->image_path,
                ];
            }
        }

        return $popularProducts;
    }
}
