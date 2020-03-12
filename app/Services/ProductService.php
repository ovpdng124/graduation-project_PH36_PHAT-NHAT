<?php

namespace App\Services;

use App\Entities\Product;
use App\Entities\ProductImage;
use App\Filters\ProductFilter;
use App\Helpers\GlobalHelper;
use Illuminate\Support\Arr;

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

            if (GlobalHelper::checkExpiredDate($product->updated_at, 7)) {
                $product->is_new = false;
            }
        }

        return $chunk->merge($products);
    }

    public function getPopularProducts($products)
    {
        $products       = $products->sortByDesc('order_products_count')->take(3);
        $popularProduct = [];
        $count          = 1;

        foreach ($products as $key => $product) {
            $image_path                         = $product->product_images->first()->image_path;
            $popularProduct["product" . $count] = $product->id;
            $popularProduct["image" . $count]   = $image_path;

            $count++;
        }

        return $popularProduct;
    }
}
